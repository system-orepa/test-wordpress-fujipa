/**
 * 入力支援モジュール
 *
 * @Filename    mts-assistance.js
 * @Author      S.Hayashi
 * @Code        2015-12-08 Ver.1.0.0
 *
 * Updated to 1.1.2 on 2017-08-07
 * Updated to 1.1.1 on 2017-07-19
 * Updated to 1.1.0 on 2017-03-09
 */
var MtsAssistance = function($)
{

    // ローディングアイコン表示 ON OFF
    var loadingIcon = function(iconId, loading)
    {
        var attr = loading ? 'inline-block' : 'none';

        $('#' + iconId).css('display', attr);
    };

    /**
     * 郵便番号検索
     *
     */
    this.findByPostcode = function()
    {
        var setsegs = [];
        var segId = arguments[0];

        for (var i = 1; i < arguments.length; i++) {
            setsegs[i - 1] = arguments[i];
        }

        // セットするセグメントを確認
        if (setsegs.length <= 0) {
            return;
        }

        var iconId = segId + "-loading";
        loadingIcon(iconId, true);

        $.ajax({
            type : 'get',
            url : this.getProtocol() + '://maps.googleapis.com/maps/api/geocode/json',
            crossDomain : true,
            dataType : 'json',
            data : {
                address : this.zenToHan($("#" + segId).val()),
                language : 'ja',
                sensor : false
            },
            success : function(ret){
                loadingIcon(iconId, false);
                if (ret.status == "OK" && isDomestic(ret.results[0].formatted_address)) {
                    setAddress(setsegs, ret.results[0].address_components);
                } else {
                    clearInput(setsegs, 0);
                }
                return false;
            }
        });
    };

    // 国内の住所か確認する
    var isDomestic = function(fmtaddr)
    {
        return fmtaddr.match(/日本/);
    };

    /**
     * 住所を指定セグメントにセットする
     *
     * @setseg  フォームのセグメントID配列
     * @addr    Google Geocoding APIの検索結果(都道府県は配列降順、最後は郵便番号)
     */
    var setAddress = function(setseg, addr)
    {
        var idx = 0;

        // 未設定の入力項目をクリアする
        clearInput(setseg, idx);

        locality = addr.pop();

        // 先頭が「日本」でない場合は検索結果なしとする
        if (isDomestic(locality.long_name)) {
            for (var i = addr.length; 0 < i; i--) {
                locality = addr.pop();
                if (!locality.long_name.match(/\d{3}-\d{4}/)) {
                    var $addseg = $('#' + setseg[idx]);
                    $addseg.val($addseg.val() + locality.long_name);
                    if (idx + 1 < setseg.length) {
                        idx++;
                    }
                }
            }
        }
    };

    // 未設定の入力項目をクリアする
    var clearInput = function(setseg, idx)
    {
        for ( ; idx < setseg.length; idx++) {
            $('#' + setseg[idx]).val('');
        }
    };

    /**
     * 参照プロトコルの取得
     */
    this.getProtocol = function()
    {
        matches = location.href.match(/^(https?).*/);

        if (0 < matches.length) {
            return matches[1];
        }

        return 'http';
    };

    /**
     * 英数字全角半角変換
     */
    this.zenToHan = function(postcode)
    {
        var str = postcode.replace(/ー/g, '－');

        str = str.replace(/[０-９Ａ-Ｚａ-ｚ－]/g, function(s) {
            return String.fromCharCode(s.charCodeAt(0) - 0xfee0)
        });

        return str;
    };

    /**
     * 本日日付を入力フォームにセットする
     */
    this.getToday = function (inputId)
    {
        var today = new Date;

        $('#' + inputId).val(today.getFullYear()
            + '-' + figure2(today.getMonth() + 1) + '-' + figure2(today.getDate()));
    };

    // ２桁数字
    var figure2 = function (num)
    {
        var numStr = '0' + num;

        return numStr.substr(-2, 2);
    };

    /**
     * $(document).ready
     */
    $(document).ready(function() {
/*
        // カレンダー開始曜日
        //var startWeek = $("#start-of-week")[0] ? $("#start-of-week").val() : 0;
        var startWeek = mts_start_of_week ? mts_start_of_week : 0;

        // jQuery-ui datepickerの日付設定
        $(".date-box").datepicker({
            dateFormat : 'yy-mm-dd',
            yearSuffix : '年',
            showMonthAfterYear : true,
            dayNamesMin : ['日', '月', '火', '水', '木', '金', '土'],
            monthNames : ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],
            firstDay : startWeek
            //beforeShow : function(input, inst) {
            //    if (inst.id == 'break' && $("#break").val() == '') {
            //        $(this).datepicker('setDate', $("#start").val());
            //    }
            //}
        });
*/
    });

};

var mts_assistance = new MtsAssistance(jQuery);
