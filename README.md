MGOD Metadata RESTful Service API
=
Author: Trần Kim Hiếu kimhieu@tgm.vn
Version 1.0

#Change Log
## v 0.1 ##
* Phiên bản đầu tiên
* Hổ trợ lấy GET, PUT, DELETE, POST cho một item

## v 0.2 ##
* Hổ trợ trả lỗi theo JSON + Bắt tất cả các exception
* Hổ trợ GET by Username và Category ID
* Hổ trợ Paging cho GET by Username và Category ID
* Add Heroku Demo App http://tgm-mgod-rest.herokuapp.com/index.php/
## v 0.3 ##
* Chuyển đổi paging thành dạng ?page=a&limit=b
* Thêm bảng favorite_item
* Thêm RESTful API cho /favorite/
* Sửa một số lỗi liên quan đến báo lỗi
## v 1.0 - Big Upgrade ##
* Thêm Lớp TGMToken để thực iện việc xác thực khi gửi và nhận Request
* Hổ trợ Caching bằng Redis.io để tăng tốc cho quá trình GET

# Thông Tin #
**Ngôn ngữ**: PHP5
**Database**: MySQL
__Môi trường__: Apache + MySQL + PHP

# Framework #


#### RedBeanPHP ####
##### ORM, Easy export to JSON #####
https://github.com/gabordemooij/redbean
#### Slim ####
##### Request Router, RESTful cover #####
https://github.com/codeguy/Slim
#### IdiORM ####
##### ORM, Easy to get data for CRUD #####
https://github.com/j4mie/idiorm

# Framework Config #
## Slim ##
Đăng ký Slim với Instant của Request
```
\Slim\Slim::registerAutoloader();
```