// $(document).ready(function () {
//
//     /*loads initialize count menu*/
//     $('#startPageContent').load('initializeCount.php');
//
//     /*load category menu*/
//     function getCategoryMenu() {
//         var getCatMenu = $.post('categoryMenu.php');
//         getCatMenu.done(function (data) {
//             console.log("received cat menu #categoryMenu.html: " + $('#categoryMenu').html());
//             $('#categoryMenu').html(data);
//             console.log("#category menu data:  " + data);
//         });
//         getCatMenu.fail(function (data) {
//             console.log("failed at getting cat menu:");
//         });
//
//     }
//
//     /*initialize session variables*/
//     function initializeSession() {
//         var formData = {
//             'currDate': $('#dateSel').val(),
//             'categoryID': $('#categorySel').val(),
//             'locationID': $('#locationSel').val(),
//             'initializeCount': true
//         };
//         var url = '../inc/cfgGlobal.php';
//         var initialize = $.post(url, formData);
//         initialize.done(function (data) {
//             console.log('set initial session values'+ $('#categoryMenu').html());
//             window.location.href = 'count.html';
//         });
//         initialize.fail(function (data) {
//             console.log("failed initialized session:  ");
//         });
//     }
//
//     /*load count page*/
// /*    function loadCountPage() {
//         var url2 = 'count.html';
//         var get2ndPage = $.post(url2);
//         get2ndPage.done(function (data) {
//             console.log("count page loaded ; ");
//             $('#container').html(data);
//             console.log("inside loading countPage before getCategoryMenu function:  " + $('#categoryMenu').html());
//         });
//         get2ndPage.fail(function (data) {
//             console.log("failed loading second page");
//         })
//     }*/
//
//
//
//
//
// });
//
// /*$('#countStartedPage').ready(function () {
//
//     getCategoryMenu();
//
//
//
// });*/
