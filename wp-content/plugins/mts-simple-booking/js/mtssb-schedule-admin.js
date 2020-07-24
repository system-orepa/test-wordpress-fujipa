/**
 * MTS Simple Booking 管理画面スケジュール編集操作
 *
 * @Filename	mtssb-schedule-admin.js
 * @Date		2012-06-xx
 * @Author		S.Hayashi
 * @Version		1.0.0
 *
 * Updated to 1.14.0 on 2014-01-18
 * Updated to 1.6.0 on 2013-03-18
 */
jQuery(document).ready(function($) {

	var $input;

    // Noteダイアログ定義
    var noteDialog = function()
    {
        var param = {
            //'autoOpen' : false,
            'dialogClass' : 'wp-dialog',
            'modal' : true,
            'width' : 300,
            'title' : $("#schedule-note .title").text(),
            'closeOnEscape' : true,
            'buttons' : [
                {
                    'text' : 'OK',
                    'class' : 'button-secondary',
                    'click' : function() {
                        $input.val($("#schedule-note-input").val());
                        $(this).dialog("close");
                    }
                },
                {
                    'text' : 'キャンセル',
                    'class' : 'button-secondary',
                    'click' : function() {
                        $(this).dialog("close");
                    }
                }
            ]
        };

        $("#schedule-note").dialog(param).dialog('open');

    };

    // Note ダイアログ表示
    $(".schedule-note input").focus(function() {
        // 入力にダイアログを利用する設定か確認する
        if ($("#schedule-dialog").val() != 0) {
            if ($("#focus-flag").val() == 0) {
                $("#focus-flag").val(1);
                $input = $(this);
                $("#schedule-note-input").val($input.val());
                noteDialog();
            } else {
                $("#focus-flag").val(0);
            }
        }
    });

	// 全日付チェック操作
	$("#schedule-check-all").change(function() {
		if ($(this).get(0).checked) {
			$(".schedule-open input").attr('checked', 'checked').parent().addClass('open');
			$(".schedule-box.column-title label input").attr('checked', 'checked');
		} else {
			$(".schedule-open input").removeAttr('checked').parent().removeClass('open');
			$(".schedule-box.column-title label input").removeAttr('checked');
		}
	});

	// 特定曜日日付チェック操作
	$(".schedule-box.column-title input").change(function() {
		var week = $(this).attr('class');

		if ($(this).get(0).checked) {
			$(".schedule-open ." + week).attr('checked', 'checked').parent().addClass('open');
		} else {
			$(".schedule-open ." + week).removeAttr('checked').parent().removeClass('open');
		}
	});

	// 特定日付チェック操作
	$(".schedule-open input").change(function() {
		if ($(this).get(0).checked) {
			$(this).parent().addClass('open');
		} else {
			$(this).parent().removeClass('open');
		}
	});


});
