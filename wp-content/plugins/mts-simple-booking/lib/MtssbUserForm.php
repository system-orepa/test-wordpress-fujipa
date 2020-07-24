<?php
if (!class_exists('MtssbUserFormTemp')) {
    require_once(__DIR__ . '/MtssbFormCommon.php');
    if (is_file(__DIR__ . '/temp/MtssbUserFormTemp.php')) {
        require_once(__DIR__ . '/temp/MtssbUserFormTemp.php');
    } else {
        require_once(__DIR__ . '/MtssbUserFormTemp.php');
    }
}
/**
 * MTS Simple Booking クライアントデータフォーム処理
 *
 * @Filename    MtssbUserForm.php
 * @Date		2014-11-28
 * @Implemented Ver.1.20.0
 * @Author		S.Hayashi
 */
class MtssbUserForm
{
    const JS = 'js/mtssb-register.js';
    const LOADING = 'image/ajax-loaderf.gif';

    // コントローラー
    private $ctrl = null;

    // テンプレートオブジェクト
    private $oTemp = null;


    public function __construct(MTSSB_Register $controller)
    {
        global $mts_simple_booking;

        $this->ctrl = $controller;

        // テンプレートオブジェクト生成
        $this->oTemp = new MtssbUserFormTemp;

        // 住所検索JSの挿入
		wp_enqueue_script('mtssb-register', $mts_simple_booking->plugin_url . self::JS, array('jquery'));
    }

    /**
     * ユーザー登録完了メールフォームを戻す
     *
     */
    public function registerMailForm($user, $shop)
    {
        return $this->oTemp->registerMail($this->_escUser($user, false), (object) $shop);
    }

    /**
     * ユーザー登録確認フォーム出力
     *
     */
    public function confirmForm($user)
    {
        return $this->oTemp->confirmationForm($this->_escUser($user), $this->_ctrlInfo('confirm'));
    }

    /**
     * ユーザー登録フォーム出力
     *
     * @user    ユーザーデータ
     * @err     エラーデータ
     */
    public function registerForm($user, $err)
    {
        $oError = $this->_errMessage($err, $this->ctrl->formItems());
        $oError->email2 = array_key_exists('email2', $err) ? $this->_errorField($err['email2']) : '';

        return $this->oTemp->inputForm($this->_escUser($user), $oError, $this->_ctrlInfo('entry'));
    }

    // ユーザーデータをエスケープする
    private function _escUser($user, $doEsc=true)
    {
        foreach ($user as &$property) {
            if (is_array($property)) {
                $property = $this->_escUser($property, $doEsc);
            } elseif ($doEsc) {
                $property = esc_html($property);
            }
        }

        return (object) $user;
    }

    // エラーメッセージを生成する
    private function _errMessage($err, $formItems)
    {
        $error = new stdClass;

        foreach ($formItems as $column => $require) {
            if (is_array($require)) {
                $customErr = empty($err[$column]) ? array() : $err[$column];
                $error->$column = $this->_errMessage($customErr, $require);
            } elseif (!empty($err[$column])) {
                $error->$column = $this->_errorField($err[$column]);
            } else {
                $error->$column = '';
            }
        }

        return $error;
    }

    // フォーム送信の管理データを生成する
    private function _ctrlInfo($action)
    {
        global $mts_simple_booking;

        return (object) array(
            'action' => $action,
            'nonce' => wp_create_nonce(get_class($this)),
            'time' => time(),
            'loadingImg' => $mts_simple_booking->plugin_url . self::LOADING,
        );
    }

    /**
     * 入力項目のエラー出力
     *
     */
    private function _errorField($errCode)
    {
        static $errMessage = array(
            'INVALID_LENGTH' => '入力文字の長さが無効です。',
            'INVALID_CHARACTER' => '無効な文字が入力されました。',
            'INVALID_EMAIL' => 'メールアドレスの形式が正しくありません。',
            'DIFFERENT_EMAIL' => '再入力のメールアドレスが一致しません。',
            'USED_ALREADY' => '入力データは登録済みです。',
            'REQUIRED' => '必須入力項目です。',
            'UNPROCESSED' => '未処理状態です。',
        );

        return sprintf('<div class="error-message">%s</div>',
            isset($errMessage[$errCode]) ? $errMessage[$errCode] : $errCode);
    }

    /**
     * エラー終了の出力
     *
     */
    public function errorOut($errCode)
    {
        static $errMessage = array(
            'MISSING_DATA' => 'パラメータエラーです。',
            'OUT_OF_DATE' => '操作が正しくありません。',
            'NOT_SELECTED' => '予約の入力を確認して下さい。',
            'OVER_TIME' => '時間がオーバーしました。',
            'FAILED_INSERT' => '新規登録でエラーが発生しました。',
            'FAILED_SENDING' => '登録メールの送信を失敗しました。確認のためご連絡下さい。'
        );

        if (array_key_exists($errCode, $errMessage)) {
            $msg = $errMessage[$errCode];
        } else {
            $msg = $errCode;
        }

        return sprintf('<div class="mtssb-error-content">%s</div>', $msg);
    }

    /**
     * ページメッセージ出力
     *
     */
    public function messageOut($code)
    {
        static $message = array(
            'REGISTERED' => 'ユーザー登録を実行、仮パスワードをメール送信いたしました。',
        );

        if (array_key_exists($code, $message)) {
            $msg = $message[$code];
        } else {
            $msg = $code;
        }

        return sprintf('<div class="mtssb-message-content">%s</div>', $msg);
    }

    /**
     * カスタム項目取得
     *
     */
    public function customItems()
    {
        return $this->oTemp->customItems();
    }

    /**
     * カスタムデータ初期化
     *
     */
    public function clearCustom()
    {
        return $this->oTemp->clearCustom();
    }

    /**
     * カスタムデータの入力処理
     *
     */
    public function inputCustom()
    {
        return $this->oTemp->inputCustom();
    }

    /**
     * カスタムデータのチェック処理
     *
     */
    public function checkCustom($values)
    {
        return $this->oTemp->checkCustom($values);
    }

}
