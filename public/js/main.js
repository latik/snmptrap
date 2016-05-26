$(document).ready(function () {
    $('#districtTabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
        filter = $(this).data('district');
    });
});
