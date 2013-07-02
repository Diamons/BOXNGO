<?php
	class ConciergesController extends AppController{
		
		var $uses = array('Course', 'Shop');
		var $helpers = array('Book');
		
		public function beforeFilter(){
			parent::beforeFilter();
			$this->Auth->allow(array('hunter_college'));
		}
		
		public function hunter_college($course=NULL){
			if(isset($course)){

				$searched = $this->Course->find("first", array("fields" => array("Course.code", "Course.full_text", "Course.course_number"), "conditions" => array("Course.code" => $course)));
				$similar = $this->Course->find("all", array("fields" => array("Course.code", "Course.full_text", "Course.course_number"), "conditions" => array("Course.course_number" => str_replace("\\u00a0", " ", $searched['Course']['course_number']))));
				
				$html = new DOMDocument();
				$books = array();
				$count = 0;
				foreach($similar as $a){
					$html->loadHTMLFile("http://db1.hunter.cuny.edu:7777/pls/sims/cls.cs_pkg8.textbook_info?p_code=".$a['Course']['code']."&p_month=02N&p_year=13");
					$xpath = new DomXpath($html);
					$rows = $xpath->query('//*[@class="highlight-row"]');
					foreach($rows as $row){
						$books[$count]['title'] = $row->getElementsByTagName("td")->item(2)->nodeValue;
						$books[$count]['isbn'] = $row->getElementsByTagName("td")->item(5)->nodeValue;
						$books[$count]['listings'] = $this->Shop->find('all', array('conditions' => array('OR' => array('Shop.name LIKE' => "%".$books[$count]['title']."%", 'Shop.description LIKE' => "%".$books[$count]['title']."%"), 'AND' => array('Shop.canview' => 1))));
						$count++;
					}
					//echo $html->saveHTML($row);
				}
				$books = array_unique($books, SORT_REGULAR);
				$this->set(compact("similar", "searched", "books"));
				$this->render("books");
			
			}elseif($this->request->is('post')){
				$this->redirect($this->request->here.'/'.$this->request->data['Course']['course_number']);
			}else{
				$this->render("concierge");
			}
		}
	}