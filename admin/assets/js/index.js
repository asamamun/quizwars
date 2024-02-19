
window.addEventListener('DOMContentLoaded', event => {
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }
});



function actionFunb() {
    $cat_id_send = document.getElementById("category_id").value;
    fetch(`quize_api.php?category_id=${$cat_id_send}`).then(x => x.text()).then(y => myDisplay(y));

    function myDisplay(data) {
        document.getElementById("subcategory_id").innerHTML = data;
    }
}


$(document).ready(function(){
    $(document).on('click','.hello', function(){
        $result = $(this).next('input').val();
        $('#crrAns').val($result);
    })
})




