<h2>Collector Crm</h2>

<h3> Sections </h3>
<ul>
    <li><a href="#description"> Description</a></li>
    <li><a href="#Installation" >Install</a></li>
</ul>

<h3 id="description">Description</h3>

<h4> Rules </h4>
<ul>
    <li>Admin</li>
    <li>Operator</li>
</ul>

<p>Admin can create/update/delete/listing/getOne/Create Custom Fields for any entity</p>
<p>Operator can listing/getOne/Fill Cutom Filleds Created By Admin for any entity</p>

<p>Collector CRM Models: Book Mode,Courses Mode</p>

<b>Caution: You wont be able to use the route of certain mode unitl system admin activate it, also you have to know that this crm api has been tested on windows only </b>

<h3 id="Installation">Install</h3>

1) Pull it from git
```
git pull https://github.com/Neamix/Collector-Crm.git 
```

2) change .env.example to .env
3) Install dependancies
```
php artisan composer install
```
5) generate jwt secret
```
php artisan jwt:secret 
```



