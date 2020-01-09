<?php
 
namespace app\models;
 
use Yii;
use yii\base\Model;
 
/**
 * Signup form
 */
class SignupForm extends Model
{
 
    public $phone;
    public $first_name;
    public $last_name;
    public $patronymic;
    public $gender;
    public $date_birth;
    public $password;

    public function rules()
    {
        return [
            [['phone', 'first_name', 'last_name', 'patronymic', 'gender', 'date_birth'], 'trim'],
            [['phone', 'password'], 'required'],
            [['first_name', 'last_name'], 'required', 'message' => 'Кириллица, ввод с заглавной буквы, может присутствовать 1 дефис'],
            [
                ['first_name', 'last_name', 'patronymic'],
                'match',
                'pattern' => '/^[А-ЯЁ]([а-яё]+)([-]?)([а-яё]+)$/iu',
                'message' => 'Кириллица, ввод с заглавной буквы, может присутствовать 1 дефис'
            ],
            ['phone', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Пользователь с таким телефоном уже зарегистрирован.'],
            ['phone', 'match', 'pattern' => '/^[0-9]{10,12}$/', 'message' => 'Телефон должен состоять только из цифр (10-12)'],
            [['first_name', 'last_name', 'patronymic'], 'string', 'min' => 2, 'max' => 255],
            [
                'date_birth',
                'match',
                'pattern' => '/^(0[1-9]|[12][0-9]|3[01])[\-\/.](0[1-9]|1[012])[\-\/.](19|20)\d\d$/',
                'message' => 'Неверный формат даты должен быть 01.01.2000'
            ],
            ['password', 'match', 'pattern' => '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/', 'message' => 'Минимум 6 символов, цифры и буквы'],
        ];
    }
 
    /**
     * @return User
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
 
        $user = new User();
        $user->phone = $this->phone;
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->patronymic = $this->patronymic;
        $user->gender = $this->gender;
        $user->date_birth = $this->date_birth;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save() ? $user : null;
    }
}
