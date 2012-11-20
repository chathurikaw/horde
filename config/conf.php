<?php
/* CONFIG START. DO NOT CHANGE ANYTHING IN OR AFTER THIS LINE. */
// $Horde: horde/config/conf.xml,v 1.74.2.89 2010/04/21 08:02:24 jan Exp $
$conf['vhosts'] = false;
$conf['debug_level'] = E_ALL & ~E_NOTICE;
$conf['max_exec_time'] = 0;
$conf['compress_pages'] = true;
$conf['secret_key'] = '2be0dcf447a8eda55592a68c31165b78115c13e5';
$conf['umask'] = 077;
$conf['use_ssl'] = 2;
$conf['server']['name'] = $_SERVER['SERVER_NAME'];
$conf['urls']['token_lifetime'] = 30;
$conf['urls']['hmac_lifetime'] = 30;
$conf['urls']['pretty'] = false;
$conf['safe_ips'] = array();
$conf['session']['name'] = 'Horde';
$conf['session']['use_only_cookies'] = false;
$conf['session']['cache_limiter'] = 'nocache';
$conf['session']['timeout'] = 0;
$conf['cookie']['domain'] = $_SERVER['SERVER_NAME'];
$conf['cookie']['path'] = '/horde';
$conf['sql']['persistent'] = false;
$conf['sql']['username'] = 'root';
$conf['sql']['password'] = '123';
$conf['sql']['hostspec'] = 'localhost';
$conf['sql']['port'] = 3306;
$conf['sql']['protocol'] = 'tcp';
$conf['sql']['database'] = 'horde';
$conf['sql']['charset'] = 'utf-8';
$conf['sql']['ssl'] = false;
$conf['sql']['splitread'] = false;
$conf['sql']['phptype'] = 'mysql';
$conf['auth']['admins'] = array('john@example.com');
$conf['auth']['checkip'] = true;
$conf['auth']['checkbrowser'] = true;
$conf['auth']['alternate_login'] = false;
$conf['auth']['redirect_on_logout'] = false;
$conf['auth']['list_users'] = 'list';
$conf['auth']['params']['app'] = 'imp';
$conf['auth']['driver'] = 'application';
$conf['signup']['allow'] = true;
$conf['log']['priority'] = PEAR_LOG_NOTICE;
$conf['log']['ident'] = 'HORDE';
$conf['log']['params'] = array();
$conf['log']['name'] = '/tmp/horde.log';
$conf['log']['params']['append'] = true;
$conf['log']['type'] = 'file';
$conf['log']['enabled'] = true;
$conf['log_accesskeys'] = false;
$conf['prefs']['params']['driverconfig'] = 'horde';
$conf['prefs']['driver'] = 'sql';
$conf['alarms']['params']['driverconfig'] = 'horde';
$conf['alarms']['params']['ttl'] = 300;
$conf['alarms']['driver'] = 'sql';
$conf['datatree']['params']['driverconfig'] = 'horde';
$conf['datatree']['driver'] = 'sql';
$conf['group']['driverconfig'] = 'horde';
$conf['group']['driver'] = 'sql';
$conf['group']['cache'] = false;
$conf['perms']['driverconfig'] = 'horde';
$conf['perms']['driver'] = 'sql';
$conf['share']['no_sharing'] = false;
$conf['share']['any_group'] = false;
$conf['share']['cache'] = false;
$conf['share']['driver'] = 'sql';
$conf['cache']['default_lifetime'] = 86400;
$conf['cache']['params']['sub'] = 0;
$conf['cache']['driver'] = 'file';
$conf['lock']['params']['driverconfig'] = 'horde';
$conf['lock']['driver'] = 'sql';
$conf['token']['params']['driverconfig'] = 'horde';
$conf['token']['driver'] = 'sql';
$conf['mailer']['params']['sendmail_path'] = '/usr/lib/sendmail.postfix';
$conf['mailer']['params']['sendmail_args'] = '-oi';
$conf['mailer']['type'] = 'sendmail';
$conf['mailformat']['brokenrfc2231'] = false;
$conf['vfs']['params']['driverconfig'] = 'horde';
$conf['vfs']['type'] = 'sql';
$conf['sessionhandler']['type'] = 'none';
$conf['sessionhandler']['memcache'] = false;
$conf['problems']['email'] = 'john@example.com';
$conf['problems']['maildomain'] = 'example.com';
$conf['problems']['tickets'] = false;
$conf['problems']['attachments'] = true;
$conf['menu']['apps'] = array();
$conf['menu']['always'] = false;
$conf['menu']['links']['help'] = 'all';
$conf['menu']['links']['options'] = 'authenticated';
$conf['menu']['links']['problem'] = 'all';
$conf['menu']['links']['login'] = 'all';
$conf['menu']['links']['logout'] = 'authenticated';
$conf['hooks']['permsdenied'] = false;
$conf['hooks']['username'] = false;
$conf['hooks']['preauthenticate'] = false;
$conf['hooks']['postauthenticate'] = false;
$conf['hooks']['authldap'] = false;
$conf['hooks']['groupldap'] = false;
$conf['portal']['fixed_blocks'] = array();
$conf['accounts']['driver'] = 'null';
$conf['user']['verify_from_addr'] = false;
$conf['imsp']['enabled'] = false;
$conf['kolab']['enabled'] = false;
$conf['memcache']['enabled'] = false;
/* CONFIG END. DO NOT CHANGE ANYTHING IN OR BEFORE THIS LINE. */
