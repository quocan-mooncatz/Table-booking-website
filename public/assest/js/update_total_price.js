// Xử lý sự kiện khi có sự thay đổi trong bàn đặt hoặc các món ăn được chọn
document.addEventListener('DOMContentLoaded', function() {
    var bandatSelect = document.getElementById('bandat');
    var monanCheckboxes = document.querySelectorAll('input[name="tenmon[]"]');
    var tonggiaInput = document.getElementById('tonggia');

    function updateTotalPrice() {
        var formData = new FormData();
        formData.append('bandat', bandatSelect.value);

        monanCheckboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                formData.append('tenmon[]', checkbox.value);
            }
        });

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_total_price.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                tonggiaInput.value = xhr.responseText;
            }
        };
        xhr.send(formData);
    }

    bandatSelect.addEventListener('change', updateTotalPrice);
    monanCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', updateTotalPrice);
    });

    // Gọi hàm updateTotalPrice lần đầu tiên để hiển thị tổng giá ban đầu
    updateTotalPrice();
});
