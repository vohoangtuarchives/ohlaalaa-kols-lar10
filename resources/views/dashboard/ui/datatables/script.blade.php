<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {

        var datatableColumns = @json($columns ?? '{}');
        let table = new DataTable('#datatables-html', {
            processing: true,
            serverSide:true,
            paging: true,
            ordering: true,
            info: false,
            searching:true,
            fixedHeader: true,
            "pageLength": 15,
            order: [[1, 'asc']],
            "ajax":{
                "url": "{{ url()->current() }}",
                "dataType": "json",
                "type": "GET",
                "data":{
                    _token: "{{csrf_token()}}",
                }
            },
            "columns": datatableColumns

        });
        var customBtnSubmit = document.getElementById("custom-btn-submit");
        var customInputSearch = document.getElementById("custom-input-search");

        customBtnSubmit.addEventListener("click", function (value) {
            table.search(customInputSearch.value ).draw();
        });
        var checkAll = document.getElementById("checkAll");
        if (checkAll) {
            checkAll.onclick = function () {
                var checkboxes = document.querySelectorAll('.form-check-all input[type="checkbox"]');
                var checkedCount = document.querySelectorAll('.form-check-all input[type="checkbox"]:checked').length;
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = this.checked;
                    if (checkboxes[i].checked) {
                        checkboxes[i].closest("tr").classList.add("table-active");
                    } else {
                        checkboxes[i].closest("tr").classList.remove("table-active");
                    }
                }
            };
        }
    });



    function ready(callback){
        // in case the document is already rendered
        if (document.readyState!='loading') callback();
        // modern browsers
        else if (document.addEventListener) document.addEventListener('DOMContentLoaded', callback);
        // IE <= 8
        else document.attachEvent('onreadystatechange', function(){
                if (document.readyState=='complete') callback();
            });
    }

    function waitForElm(selector) {
        return new Promise(resolve => {
            if (document.querySelector(selector)) {
                return resolve(document.querySelector(selector));
            }

            const observer = new MutationObserver(mutations => {
                if (document.querySelector(selector)) {
                    resolve(document.querySelector(selector));
                    observer.disconnect();
                }
            });

            observer.observe(document.body, {
                childList: true,
                subtree: true
            });
        });
    }

    waitForElm('.dataTable-checkbox').then((elm) => {
        var checkboxItems = document.querySelectorAll(".dataTable-checkbox");
        if(checkboxItems){
            Array.from(checkboxItems).forEach(function (item) {
                item.addEventListener('click', function (event) {
                    if (event.target.checked == true) {
                        event.target.closest('tr').classList.add("table-active");
                    } else {
                        event.target.closest('tr').classList.remove("table-active");
                    }
                });
            });
        }
    });

</script>