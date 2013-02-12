<?php
    //API Key - see http://admin.mailchimp.com/account/api
    $config['Mailchimp']['apikey'] = '06f09f2ad7e26133f0fc065135fa3690-us2';
    
    // A List Id to run examples against. use lists() to view all
    // Also, login to MC account, go to List, then List Tools, and look for the List ID entry
    $config['Mailchimp']['listId'] = '0c5ba54ed0';
    
    // A Campaign Id to run examples against. use campaigns() to view all
    $config['Mailchimp']['campaignId'] = '';

    //some email addresses used in the examples:
    $config['Mailchimp']['my_email'] = 'support@theboxngo.com';
    $config['Mailchimp']['boss_man_email'] = 'support@theboxngo.com';

    //just used in xml-rpc examples
    $config['Mailchimp']['apiUrl'] = 'http://api.mailchimp.com/1.3/';
	
?>
