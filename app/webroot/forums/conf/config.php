<?php if (!defined('APPLICATION')) exit();

// Conversations
$Configuration['Conversations']['Version'] = '2.0.18.8';

// Database
$Configuration['Database']['Name'] = 'heroku_5648c9c067c6638';
$Configuration['Database']['Host'] = 'us-cdbr-east-03.cleardb.com';
$Configuration['Database']['User'] = 'bf9d3d7e7eb560';
$Configuration['Database']['Password'] = 'aadf777b';

// EnabledApplications
$Configuration['EnabledApplications']['Conversations'] = 'conversations';
$Configuration['EnabledApplications']['Vanilla'] = 'vanilla';

// EnabledPlugins
$Configuration['EnabledPlugins']['GettingStarted'] = 'GettingStarted';
$Configuration['EnabledPlugins']['HtmLawed'] = 'HtmLawed';
$Configuration['EnabledPlugins']['Emotify'] = TRUE;
$Configuration['EnabledPlugins']['Flagging'] = TRUE;
$Configuration['EnabledPlugins']['VanillaInThisDiscussion'] = TRUE;
$Configuration['EnabledPlugins']['SplitMerge'] = TRUE;
$Configuration['EnabledPlugins']['Tagging'] = TRUE;
$Configuration['EnabledPlugins']['VanillaStats'] = TRUE;
$Configuration['EnabledPlugins']['cleditor'] = TRUE;
$Configuration['EnabledPlugins']['Facebook'] = TRUE;
$Configuration['EnabledPlugins']['Voting'] = TRUE;

// Garden
$Configuration['Garden']['Title'] = "BOX'NGO Forums";
$Configuration['Garden']['Cookie']['Salt'] = 'SE37IFCR4H';
$Configuration['Garden']['Cookie']['Domain'] = '';
$Configuration['Garden']['Registration']['ConfirmEmail'] = '1';
$Configuration['Garden']['Registration']['Method'] = 'Captcha';
$Configuration['Garden']['Registration']['ConfirmEmailRole'] = '3';
$Configuration['Garden']['Registration']['CaptchaPrivateKey'] = '6LdqCuISAAAAAEUrTHiJsdrYhGSokJ51b3U8mR0k';
$Configuration['Garden']['Registration']['CaptchaPublicKey'] = '6LdqCuISAAAAACRFxQqZ9HJ01U5xQ9wdYNm8OsLS';
$Configuration['Garden']['Registration']['InviteExpiration'] = '-1 week';
$Configuration['Garden']['Registration']['InviteRoles'] = 'a:5:{i:3;s:1:"0";i:4;s:1:"0";i:8;s:1:"0";i:16;s:1:"0";i:32;s:1:"0";}';
$Configuration['Garden']['Email']['SupportName'] = "BOX'NGO Forums";
$Configuration['Garden']['Email']['SupportAddress'] = 'support@theboxngo.com';
$Configuration['Garden']['Email']['UseSmtp'] = '1';
$Configuration['Garden']['Email']['SmtpHost'] = 'smtp.mailgun.org';
$Configuration['Garden']['Email']['SmtpUser'] = 'postmaster@app9620009.mailgun.org';
$Configuration['Garden']['Email']['SmtpPassword'] = '0r0wibis4w-3';
$Configuration['Garden']['Email']['SmtpPort'] = '587';
$Configuration['Garden']['Email']['SmtpSecurity'] = '';
$Configuration['Garden']['Version'] = '2.0.18.8';
$Configuration['Garden']['RewriteUrls'] = TRUE;
$Configuration['Garden']['CanProcessImages'] = TRUE;
$Configuration['Garden']['Installed'] = TRUE;
$Configuration['Garden']['Theme'] = 'defaultsmarty';
$Configuration['Garden']['ThemeOptions']['Name'] = 'Vanilla Default';
$Configuration['Garden']['ThemeOptions']['Styles']['Key'] = 'Vanilla Blue';
$Configuration['Garden']['ThemeOptions']['Styles']['Value'] = '%s';
$Configuration['Garden']['Format']['Hashtags'] = FALSE;
$Configuration['Garden']['EditContentTimeout'] = '1800';
$Configuration['Garden']['WebRoot'] = 'vanilla';
$Configuration['Garden']['StripWebRoot'] = TRUE;
// Plugins
$Configuration['Plugins']['GettingStarted']['Dashboard'] = '1';
$Configuration['Plugins']['GettingStarted']['Discussion'] = '1';
$Configuration['Plugins']['GettingStarted']['Categories'] = '1';
$Configuration['Plugins']['GettingStarted']['Plugins'] = '1';
$Configuration['Plugins']['GettingStarted']['Registration'] = '1';
$Configuration['Plugins']['Facebook']['ApplicationID'] = '116996495106723';
$Configuration['Plugins']['Facebook']['Secret'] = '616842b8158d5beb8a0d0ee771dfe9d0';
$Configuration['Plugins']['Tagging']['Enabled'] = TRUE;
$Configuration['Plugins']['Flagging']['Enabled'] = TRUE;

// Routes
$Configuration['Routes']['DefaultController'] = 'discussions';

// Vanilla
$Configuration['Vanilla']['Version'] = '2.0.18.8';
$Configuration['Vanilla']['AdminCheckboxes']['Use'] = TRUE;
$Configuration['Vanilla']['Discussions']['PerPage'] = '30';
$Configuration['Vanilla']['Comments']['AutoRefresh'] = '0';
$Configuration['Vanilla']['Comments']['PerPage'] = '15';
$Configuration['Vanilla']['Archive']['Date'] = '';
$Configuration['Vanilla']['Archive']['Exclude'] = FALSE;

// Last edited by Admin (127.0.0.1)2013-05-28 18:30:15