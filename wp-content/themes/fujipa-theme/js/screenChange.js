// プルダウンメニューで選択したURLへ画面を遷移させる jQuery 対応 2018.11.18 kazuya.okamoto

$(document).ready(function(){
  $('#area').on('change', function () {
      alert( $('#area').val() );
  });
});