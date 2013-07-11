<?php

class ShopUrlBehavior extends ModelBehavior {
	public function getFullUrl(Model $model, $id, $permalink){
		return "http://theboxngo.com/shops/viewlisting/".$id."/".$permalink;
	}
}