MGOD Metadata RESTful Service API
=
Author: Trần Kim Hiếu kimhieu@tgm.vn
Version 1.0

#Change Log
##v 0.1
* Phiên bản đầu tiên
* Hổ trợ lấy GET, PUT, DELETE, POST cho một item

##v 0.2
* Hổ trợ trả lỗi theo JSON + Bắt tất cả các exception
* Hổ trợ GET by Username và Category ID
* Hổ trợ Paging cho GET by Username và Category ID
* Add Heroku Demo App http://tgm-mgod-rest.herokuapp.com/index.php/
##v 0.3
* Chuyển đổi paging thành dạng ?page=a&limit=b
* Thêm bảng favorite_item
* Thêm RESTful API cho /favorite/
* Sửa một số lỗi liên quan đến báo lỗi
##v 1.0 - Big Upgrade
* Thêm Lớp TGMToken để thực iện việc xác thực khi gửi và nhận Request
* Hổ trợ Caching bằng Redis.io để tăng tốc cho quá trình GET

#Thông Tin
**Ngôn ngữ**: PHP5
**Database**: MySQL
__Môi trường__: Apache + MySQL + PHP

#Framework


####RedBeanPHP
#####ORM, Easy export to JSON
https://github.com/gabordemooij/redbean
####Slim
#####Request Router, RESTful cover
https://github.com/codeguy/Slim
####IdiORM
#####ORM, Easy to get data for CRUD
https://github.com/j4mie/idiorm

#Framework Config
##Slim
Đăng ký Slim với Instant của Request
```\Slim\Slim::registerAutoloader();```
Tạo ra một Slim instant để cover request
```$app = new \Slim\Slim(array('mode' => 'development', 'debug' => 'false'));```
Chuyển content-Type về JSON để dễ dàng trả kết quả
```$app->response()->header('Content-Type', 'application/json');```
##RedBean
 ```R::setup('mysql:host=localhost;dbname=test-slim', 'root', '123456');```
##IdiORM
```ORM::configure('mysql:host=localhost;dbname=test-slim');
ORM::configure('username', 'root');
ORM::configure('password', '123456');```
Chuyển về POD Command dạng UTF-8 để xữ lý Unicode
```ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));```
// Return config
```ORM::configure('return_result_sets', true); // returns result sets```
// Config id column
Đặt định dạng cho cột frimary key
```ORM::configure('id_column', 'id');```




#RESTful API

```
Method
API
Input Data
Type
Return Code
```
###v0.1

####GET
```
/item/:id
/items/all?page=:page&limit=?limit
```
__:id = int__
*URL Query String*
__Success: JSON__
__Fall: 0__

####POST
```/item/```
Data dựa theo cấu trúc bảng item_info bỏ cột id
__Form Data__
__Success: 1__
__Fall: 0__
####PUT
```/item/:id```
Data dựa theo cấu trúc bảng item_info bỏ cột id
URL Query String for id
JSON for info
__Success: 1__
__Fall: 0__
####DELETE
```/item/:id```
```:id = int```
URL Query String
__Success: 1__
__Fall: 0__

####GET by username
```/items/username/:username?page=:page&limit=?limit```
__:username__ = String
__:page__ = page number (begin by 0)
__:limit__ = item per page
URL Query String
__Success: Array JSON__
__Fall: 0__

####GET by categoryid
```/items/category/:id?page=:page&limit=?limit```
__:categoryid__ = int 
__:page__ = page number (begin by 0)
__:limit__ = item per page
URL Query String
__Success: Array JSON__
__Fall: 0__

####GET favorite
```/favorite/:id```
__:id__ = int
URL Query String
__Success: JSON__
__Fall: 0__

####POST favorite
```/favorite/```
Data dựa theo cấu trúc bảng favorite_item bỏ cột id
Form Data
__Success: 1__
__Fall: 0__
__Diplicate: 2__

####DELETE favorite
```/favorite/:id```
__:id__ = int
URL Query String
__Success: 1__
__Fall: 0__

####GET by favorite username
```/favorite/username/:usernam?page=:page&limit=?limit```
__:username__ = String
__:page__ = page number (begin by 0)
__:limit__ = item per page
URL Query String
__Success: Array JSON__
__Fall: 0__




##Database Info: 
###Table *favorite_item*
```CREATE TABLE `favorite_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` bigint(20) DEFAULT NULL,
  `username` varchar(1024) DEFAULT NULL,
  `itemid` bigint(20) DEFAULT NULL,
  `topicid` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;```

###Table *item_info*
```CREATE TABLE `item_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `posttime` bigint(20) DEFAULT NULL,
  `updatetime` bigint(20) DEFAULT NULL,
  `topicid` bigint(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `name` varchar(1024) DEFAULT NULL,
  `images` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(1024) DEFAULT NULL,
  `detail` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `username` varchar(100) DEFAULT NULL,
  `userid` varchar(100) DEFAULT NULL,
  `situation` varchar(1024) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `categoryname` varchar(100) DEFAULT NULL,
  `categoryid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Bảng lưu các thông tin phụ cho một lời rao trên MGOD - ver 1';
```


    