// Lấy tất cả các phần tử có lớp là "formatted-number"
var numberElements = document.querySelectorAll('.doigia');

// Lặp qua từng phần tử và định dạng số
numberElements.forEach(function(element) {
    // Lấy nội dung của phần tử, đây là chuỗi
    var numberString = element.innerHTML;

    // Loại bỏ các ký tự không phải số từ chuỗi
    var numberOnlyString = numberString.replace(/\D/g, '');

    // Chuyển đổi chuỗi số thành số
    var numberValue = parseInt(numberOnlyString);

    // Kiểm tra nếu giá trị là một số hợp lệ
    if (!isNaN(numberValue)) {
        // Định dạng lại chuỗi số
        var formattedNumber = numberValue.toLocaleString('en-US');

        // Thêm ký tự 'đ' vào cuối chuỗi
        formattedNumber += "đ";

        // Gán lại nội dung của phần tử với chuỗi số đã định dạng
        element.innerHTML = formattedNumber;
    } else {
        // Nếu không phải là số hợp lệ, không làm gì cả hoặc xử lý theo ý muốn của bạn
    }
});
