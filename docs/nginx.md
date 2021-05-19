Xeno web-skeleton Nginx config
==============================

- Edit as needed
- Be sure to put `/public` as the root and handle all non found files with `index.php`

```nginx
server {
	listen       127.0.0.1:80;
	server_name  web-skeleton.local;
	
	root   "C:\\www\\web-skeleton\\public";
	index  index.php;

	location / {
		try_files $uri /index.php$is_args$args;
	}
	
	location ~ \.php$ {
		fastcgi_pass   127.0.0.1:9001;
		fastcgi_index  index.php;
		fastcgi_param  SCRIPT_FILENAME  $document_root/$fastcgi_script_name;
		include        fastcgi_params;
	}
}
```
