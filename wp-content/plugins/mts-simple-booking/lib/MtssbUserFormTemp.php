<?php
/**
 * MTS Simple Booking ユーザーデータフォームテンプレート
 *
 * @Filename    MtssbUserFormTemp.php
 * @Date		2014-12-03
 * @Implemented Ver.1.20.0
 * @Author		S.Hayashi
 *
 * Updated to 1.22.0 on 2015-07-20
 */
class MtssbUserFormTemp extends MtssbFormCommon
{
    // カスタム項目設定
    public function customItems()
    {
        return array();
    }

    // カスタムデータ項目設定
    public function clearCustom()
    {
        return array();
    }

    // カスタムデータの入力処理
    public function inputCustom()
    {
        return array();
    }

    // カスタムデータのエラー処理
    public function checkCustom($custom)
    {
        $error = array();
        return $error;
    }

    // ユーザー登録入力フォーム
    public function inputForm($oUser, $err, $ctrl)
    {
        $prefSelect = $this->selectPref('user-pref', 'mts-select', 'user[pref]', $oUser->pref);

        return <<<EOD
<div class="content-form">
    <div class="form-notice"><span class="required">*</span>の項目は必須です。</div>
    <form method="post">
        <fieldset class="user-form">
            <legend>ログイン情報</legend>
            <table>
                <tr class="user-column username">
                    <th><label for="user-username">ログイン名 (<span class="required">*</span>)</label></th>
                    <td>
                        <input id="user-username" type="text" class="content-text medium" name="user[username]" value="{$oUser->username}">
                        <div class="description">半角英数字(アンダーバーを含む)で6文字以上32文字以下です。</div>
                        {$err->username}
                    </td>
                </tr>
            </table>
        </fieldset>

        <fieldset class="user-form">
            <legend>連絡先</legend>
            <table>
                <tr class="user-column email">
                    <th><label for="user-email">E Mail (<span class="required">*</span>)</label></th>
                    <td>
                        <input id="user-email" type="text" class="content-text fat" name="user[email]" value="{$oUser->email}">
                        {$err->email}
                    </td>
                </tr>
                <tr class="user-column email2">
                    <th><label for="user-email2">E Mail再入力 (<span class="required">*</span>)</label></th>
                    <td>
                        <input id="user-email2" type="text" class="content-text fat" name="user[email2]" value="{$oUser->email2}">
                        {$err->email2}
                    </td>
                </tr>
                <tr class="user-column name">
                    <th><label for="user-sei">氏　名 (<span class="required">*</span>)</label></th>
                    <td>
                        <label for="user-sei" class="user-name">姓</label>
                        <input id="user-sei" type="text" class="content-text small-medium" name="user[sei]" value="{$oUser->sei}">
                        <label for="user-mei" class="user-name">名</label>
                        <input id="user-mei" type="text" class="content-text small-medium" name="user[mei]" value="{$oUser->mei}">
                        {$err->name}
                    </td>
                </tr>
                <tr class="user-column kana">
                    <th><label for="user-sei_kana">フリガナ (<span class="required">*</span>)</label></th>
                    <td>
                        <label for="user-sei_kana" class="user-name">セイ</label>
                        <input id="user-sei_kana" type="text" class="content-text small-medium" name="user[sei_kana]" value="{$oUser->sei_kana}">
                        <label for="user-mei_kana" class="user-name">メイ</label>
                        <input id="user-mei_kana" type="text" class="content-text small-medium" name="user[mei_kana]" value="{$oUser->mei_kana}">
                        {$err->kana}
                    </td>
                </tr>
                <tr class="user-column tel">
                    <th><label for="user-tel">連絡先TEL (<span class="required">*</span>)</label></th>
                    <td>
                        <input id="user-tel" type="text" class="content-text medium" name="user[tel]" value="{$oUser->tel}">
                        {$err->tel}
                    </td>
                </tr>
                <tr class="user-column company">
                    <th><label for="user-company">会社・団体名</label></th>
                    <td>
                        <input id="user-company" type="text" class="content-text fat" name="user[company]" value="{$oUser->company}">
                        {$err->company}
                    </td>
                </tr>

                <tr class="user-column postcode">
                    <th><label for="user-postcode">郵便番号</label></th>
                    <td>
                        <input id="user-postcode" type="text" class="content-text small-medium" name="user[postcode]" value="{$oUser->postcode}">
                        <button id="mts-postcode-button" type="button" onclick="mtssb_register.findByPostcode('user-pref', 'user-city', 'user-addr1')">検索</button>
                        <img id="post-loading" src="{$ctrl->loadingImg}" style="display:none;vertical-align:middle;" alt="Loading...">
                        {$err->postcode}
                    </td>
                </tr>
                <tr class="user-column address">
                    <th><label for="user-pref">住　所 (<span class="required">*</span>)</label></th>
                    <td>
                        <dl>
                            <dt><label for="user-pref" class="user-address-header">都道府県</label></dt>
                            <dd>
                                {$prefSelect}
                            </dd>
                            <dt><label for="user-city" class="user-address-header">郡市区</label></dt>
                            <dd>
                                <input id="user-city" type="text" class="content-text fat" name="user[city]" value="{$oUser->city}">
                            </dd>
                            <dt><label for="user-addr1" class="user-address-header">町村番地</label></dt>
                            <dd>
                                <input id="user-addr1" type="text" class="content-text fat" name="user[addr1]" value="{$oUser->addr1}">
                            </dd>
                            <dt><label for="user-addr2" class="user-address-header">建物等</label></dt>
                            <dd>
                                <input id="user-addr2" type="text" class="content-text fat" name="user[addr2]" value="{$oUser->addr2}">
                            </dd>
                        </dl>
                        {$err->address}
                    </td>
                </tr>
           </table>
        </fieldset>

        <input type="hidden" name="nonce" value="{$ctrl->nonce}">
        <input type="hidden" name="start" value="{$ctrl->time}">
        <input type="hidden" name="action" value="{$ctrl->action}">
        <div id="action-button" class="register-button">
            <input type="submit" value="確認する" name="cmd">
        </div>
    </form>
</div>

EOD;
    }

    // ユーザー登録確認フォーム
    public function confirmationForm($oUser, $ctrl)
    {
        return <<<EOD
<div class="content-form">
    <form method="post">
        <fieldset class="user-form">
            <legend>ログイン情報</legend>
            <table>
                <tr class="user-column username">
                    <th>ログイン名</th>
                    <td>
                        {$oUser->username}
                        <input type="hidden" name="user[username]" value="{$oUser->username}">
                    </td>
                </tr>
            </table>
        </fieldset>

        <fieldset class="user-form">
            <legend>連絡先</legend>
            <table>
                <tr class="user-column email">
                    <th>E Mail</th>
                    <td>
                        {$oUser->email}
                        <input type="hidden" name="user[email]" value="{$oUser->email}">
                        <input type="hidden" name="user[email2]" value="{$oUser->email2}">
                    </td>
                </tr>
                <tr class="user-column name">
                    <th>氏　名</th>
                    <td>
                        {$oUser->sei} {$oUser->mei} 様
                        <input type="hidden" name="user[sei]" value="{$oUser->sei}">
                        <input type="hidden" name="user[mei]" value="{$oUser->mei}">
                    </td>
                </tr>
                <tr class="user-column kana">
                    <th>フリガナ</th>
                    <td>
                        {$oUser->sei_kana} {$oUser->mei_kana} 様
                        <input type="hidden" name="user[sei_kana]" value="{$oUser->sei_kana}">
                        <input type="hidden" name="user[mei_kana]" value="{$oUser->mei_kana}">
                    </td>
                </tr>
                <tr class="user-column tel">
                    <th>連絡先TEL</th>
                    <td>
                        {$oUser->tel}
                        <input type="hidden" name="user[tel]" value="{$oUser->tel}">
                    </td>
                </tr>
                <tr class="user-column company">
                    <th>会社・団体名</th>
                    <td>
                        {$oUser->company}
                        <input type="hidden" name="user[company]" value="{$oUser->company}">
                    </td>
                </tr>
                <tr class="user-column postcode">
                    <th>郵便番号</th>
                    <td>
                        {$oUser->postcode}
                        <input type="hidden" name="user[postcode]" value="{$oUser->postcode}">
                    </td>
                </tr>
                <tr class="user-column address">
                    <th>住　所</th>
                    <td>
                        {$oUser->pref}{$oUser->city}{$oUser->addr1}<br>
                        {$oUser->addr2}
                        <input type="hidden" name="user[pref]" value="{$oUser->pref}">
                        <input type="hidden" name="user[city]" value="{$oUser->city}">
                        <input type="hidden" name="user[addr1]" value="{$oUser->addr1}">
                        <input type="hidden" name="user[addr2]" value="{$oUser->addr2}">
                    </td>
                </tr>
           </table>
        </fieldset>

        <input type="hidden" name="nonce" value="{$ctrl->nonce}">
        <input type="hidden" name="start" value="{$ctrl->time}">
        <input type="hidden" name="action" value="{$ctrl->action}">
        <div id="action-button" class="register-button">
            <input type="submit" value="登録する" name="cmd">
            <input type="button" value="戻る" onclick="history.back()">
        </div>
    </form>
</div>

EOD;
    }

    // ユーザー登録完了メール
    public function registerMail($oUser, $oShop)
    {
        $date = date_i18n('Y年n月j日 H:i');

        return array(
            'subject' => '【ユーザー登録のお知らせ】',
            'from' => '',
            'cc' => '',
            'bcc' => '',
            'body' =>
"{$oUser->company}
{$oUser->sei} {$oUser->mei} 様

このたびはユーザー登録いただきまことにありがとうございます。
以下の通り登録が完了しましたのでお知らせいたします。

[手続き完了日] {$date}
[ユーザー名] {$oUser->username}
[仮パスワード] {$oUser->password}
[E Mail] {$oUser->email}
[お名前] {$oUser->sei} {$oUser->mei}({$oUser->sei_kana} {$oUser->mei_kana}) 様
[ご連絡先]
 〒{$oUser->postcode}
 {$oUser->pref}{$oUser->city}{$oUser->addr1}
 {$oUser->addr2}
 {$oUser->tel}

ご予約はサイトへログインしてからお申込み下さい。

またログイン中は画面上部にアドミンバーが表示され、右上のお名前からユー
ザーメニューを引き出すことができます。メニューからはプロフィールの編集
や予約データを参照いただけます。

今後ともご愛顧を賜りますようお願い申し上げます。


{$oShop->name}
{$oShop->postcode}
{$oShop->address1} {$oShop->address2}
TEL:{$oShop->tel} FAX:{$oShop->fax}
EMail:{$oShop->email}
Web:{$oShop->web}
"
        );
    }

}
