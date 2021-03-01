điều khiển truy nhập --> đối tượng --> khởi tạo 
|
|--> dùng mẫu thiết kế proxy
	|-> dùng tham chiếu --> đối tượng
	|-> tạo đại diện --> đối tượng --> dùng điều khiển
	|-> truy cập trực tiếp
		|-> thêm 
		|-> xóa
		|-> ngăn chặn

your ORM
|
|--> class Model (core)

core 
|-> Controller
|-> Model
	gồm getProperties() return get_object_vars($this);
|-> Resource (42:00)
	|-> implement ResourceInterface
	|-> sql tổng quát
	|-> method: save(), delete(), find(), all(),
|-> ResourceInterface

tasks 
|-> &Resource (49:23)
|	|-> extends Resource
|	|-> khởi tạo _init
|-> &Repository (50:00)
|	|-> new TasksResource 
|	|-> dùng phương class đó tạo implementant cho 
|	|-> method add, update, get, getAll, delete
|	|-> convert datatable to object


PDO PHP
	- tạo text câu lệnh SQL với Placeholder là ? or :key (với key tự do)
	- prepare($sql) đưa câu lệnh sql vào;
	- [bindParam(1, $name) biến đầu là vị trí ? or :key nào, biến 2 là giá trị]
	- execute([array]) thực hiện câu lệnh SQL 

	- fetch ([kiểu giá trị trả về]): lấy kết quả trả về
		fetch: trả về hàng đầu tiên
		fetchAll: trả về tất cả hàng

--> còn nhiều hàm nữa: https://viblo.asia/p/pdo-trong-php-khai-niem-va-nhung-thao-tac-co-ban-57rVRq59R4bP
--> như xử lý ngoại lệ
--> thêm dấu ` vào string 
--> thực thi sql không có đối số
--> lấy hàng có id tự động mới được thêm


insert into table (listColumn) values (listValue) 

Nên sử dụng :key

gồm 3 loại list column, list :key => value