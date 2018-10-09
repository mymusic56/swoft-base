<?php
namespace App\Models\Entity;

use Swoft\Db\Model;
use Swoft\Db\Bean\Annotation\Column;
use Swoft\Db\Bean\Annotation\Entity;
use Swoft\Db\Bean\Annotation\Id;
use Swoft\Db\Bean\Annotation\Required;
use Swoft\Db\Bean\Annotation\Table;
use Swoft\Db\Types;

/**
 * @Entity()
 * @Table(name="combos")
 * @uses      Combos
 */
class Combos extends Model
{
    /**
     * @var int $id 
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string $idAlias ID别名
     * @Column(name="id_alias", type="string", length=50, default="")
     */
    private $idAlias;

    /**
     * @var int $productTypeId 1: VIP服务，2： 录音转文字时长购买
     * @Column(name="product_type_id", type="integer", default=1)
     */
    private $productTypeId;

    /**
     * @var string $platform 平台
     * @Column(name="platform", type="string", length=32, default="")
     */
    private $platform;

    /**
     * @var string $combo 套餐名称
     * @Column(name="combo", type="string", length=50)
     * @Required()
     */
    private $combo;

    /**
     * @var int $comboTypeId 套餐类型， 1: 订单购买， 2：赠送，3：苹果连续订阅，4：按天购买会员
     * @Column(name="combo_type_id", type="tinyint", default=1)
     */
    private $comboTypeId;

    /**
     * @var string $lang 语言
     * @Column(name="lang", type="string", length=32, default="")
     */
    private $lang;

    /**
     * @var string $currencyIdentify 货币标识
     * @Column(name="currency_identify", type="string", length=10, default="")
     */
    private $currencyIdentify;

    /**
     * @var float $price 价格
     * @Column(name="price", type="decimal", default=0)
     */
    private $price;

    /**
     * @var float $mPrice 市场价
     * @Column(name="m_price", type="decimal", default=0)
     */
    private $mPrice;

    /**
     * @var int $vipExpire 有效期：单位：月， combo_type_id = 2单位为天
     * @Column(name="vip_expire", type="integer", default=0)
     */
    private $vipExpire;

    /**
     * @var int $vipUnit 单位：1：月，2：天
     * @Column(name="vip_unit", type="tinyint", default=1)
     */
    private $vipUnit;

    /**
     * @var int $sandboxExpire 测试环境有效期， 单位：秒（针对苹果内购）
     * @Column(name="sandbox_expire", type="integer", default=0)
     */
    private $sandboxExpire;

    /**
     * @var int $chargeSize VIP容量，单位B
     * @Column(name="charge_size", type="bigint", default=0)
     */
    private $chargeSize;

    /**
     * @var int $buyCount 购买数量
     * @Column(name="buy_count", type="integer", default=0)
     */
    private $buyCount;

    /**
     * @var int $sort 排序
     * @Column(name="sort", type="integer", default=0)
     */
    private $sort;

    /**
     * @var int $hidden 是否隐藏，0：不隐藏，1：隐藏
     * @Column(name="hidden", type="integer", default=0)
     */
    private $hidden;

    /**
     * @var int $enabled 套餐状态,0:禁用，1：启用
     * @Column(name="enabled", type="tinyint", default=0)
     */
    private $enabled;

    /**
     * @var int $isRecommend 1：推荐
     * @Column(name="is_recommend", type="tinyint", default=0)
     */
    private $isRecommend;

    /**
     * @var string $description 商品描述信息
     * @Column(name="description", type="string", length=255, default="")
     */
    private $description;

    /**
     * @var string $created 创建时间
     * @Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var int $ver 版本
     * @Column(name="ver", type="integer", default=0)
     */
    private $ver;

    /**
     * @param int $value
     * @return $this
     */
    public function setId(int $value)
    {
        $this->id = $value;

        return $this;
    }

    /**
     * ID别名
     * @param string $value
     * @return $this
     */
    public function setIdAlias(string $value): self
    {
        $this->idAlias = $value;

        return $this;
    }

    /**
     * 1: VIP服务，2： 录音转文字时长购买
     * @param int $value
     * @return $this
     */
    public function setProductTypeId(int $value): self
    {
        $this->productTypeId = $value;

        return $this;
    }

    /**
     * 平台
     * @param string $value
     * @return $this
     */
    public function setPlatform(string $value): self
    {
        $this->platform = $value;

        return $this;
    }

    /**
     * 套餐名称
     * @param string $value
     * @return $this
     */
    public function setCombo(string $value): self
    {
        $this->combo = $value;

        return $this;
    }

    /**
     * 套餐类型， 1: 订单购买， 2：赠送，3：苹果连续订阅，4：按天购买会员
     * @param int $value
     * @return $this
     */
    public function setComboTypeId(int $value): self
    {
        $this->comboTypeId = $value;

        return $this;
    }

    /**
     * 语言
     * @param string $value
     * @return $this
     */
    public function setLang(string $value): self
    {
        $this->lang = $value;

        return $this;
    }

    /**
     * 货币标识
     * @param string $value
     * @return $this
     */
    public function setCurrencyIdentify(string $value): self
    {
        $this->currencyIdentify = $value;

        return $this;
    }

    /**
     * 价格
     * @param float $value
     * @return $this
     */
    public function setPrice(float $value): self
    {
        $this->price = $value;

        return $this;
    }

    /**
     * 市场价
     * @param float $value
     * @return $this
     */
    public function setMPrice(float $value): self
    {
        $this->mPrice = $value;

        return $this;
    }

    /**
     * 有效期：单位：月， combo_type_id = 2单位为天
     * @param int $value
     * @return $this
     */
    public function setVipExpire(int $value): self
    {
        $this->vipExpire = $value;

        return $this;
    }

    /**
     * 单位：1：月，2：天
     * @param int $value
     * @return $this
     */
    public function setVipUnit(int $value): self
    {
        $this->vipUnit = $value;

        return $this;
    }

    /**
     * 测试环境有效期， 单位：秒（针对苹果内购）
     * @param int $value
     * @return $this
     */
    public function setSandboxExpire(int $value): self
    {
        $this->sandboxExpire = $value;

        return $this;
    }

    /**
     * VIP容量，单位B
     * @param int $value
     * @return $this
     */
    public function setChargeSize(int $value): self
    {
        $this->chargeSize = $value;

        return $this;
    }

    /**
     * 购买数量
     * @param int $value
     * @return $this
     */
    public function setBuyCount(int $value): self
    {
        $this->buyCount = $value;

        return $this;
    }

    /**
     * 排序
     * @param int $value
     * @return $this
     */
    public function setSort(int $value): self
    {
        $this->sort = $value;

        return $this;
    }

    /**
     * 是否隐藏，0：不隐藏，1：隐藏
     * @param int $value
     * @return $this
     */
    public function setHidden(int $value): self
    {
        $this->hidden = $value;

        return $this;
    }

    /**
     * 套餐状态,0:禁用，1：启用
     * @param int $value
     * @return $this
     */
    public function setEnabled(int $value): self
    {
        $this->enabled = $value;

        return $this;
    }

    /**
     * 1：推荐
     * @param int $value
     * @return $this
     */
    public function setIsRecommend(int $value): self
    {
        $this->isRecommend = $value;

        return $this;
    }

    /**
     * 商品描述信息
     * @param string $value
     * @return $this
     */
    public function setDescription(string $value): self
    {
        $this->description = $value;

        return $this;
    }

    /**
     * 创建时间
     * @param string $value
     * @return $this
     */
    public function setCreated(string $value): self
    {
        $this->created = $value;

        return $this;
    }

    /**
     * 版本
     * @param int $value
     * @return $this
     */
    public function setVer(int $value): self
    {
        $this->ver = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * ID别名
     * @return string
     */
    public function getIdAlias()
    {
        return $this->idAlias;
    }

    /**
     * 1: VIP服务，2： 录音转文字时长购买
     * @return mixed
     */
    public function getProductTypeId()
    {
        return $this->productTypeId;
    }

    /**
     * 平台
     * @return string
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * 套餐名称
     * @return string
     */
    public function getCombo()
    {
        return $this->combo;
    }

    /**
     * 套餐类型， 1: 订单购买， 2：赠送，3：苹果连续订阅，4：按天购买会员
     * @return mixed
     */
    public function getComboTypeId()
    {
        return $this->comboTypeId;
    }

    /**
     * 语言
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * 货币标识
     * @return string
     */
    public function getCurrencyIdentify()
    {
        return $this->currencyIdentify;
    }

    /**
     * 价格
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * 市场价
     * @return mixed
     */
    public function getMPrice()
    {
        return $this->mPrice;
    }

    /**
     * 有效期：单位：月， combo_type_id = 2单位为天
     * @return int
     */
    public function getVipExpire()
    {
        return $this->vipExpire;
    }

    /**
     * 单位：1：月，2：天
     * @return mixed
     */
    public function getVipUnit()
    {
        return $this->vipUnit;
    }

    /**
     * 测试环境有效期， 单位：秒（针对苹果内购）
     * @return int
     */
    public function getSandboxExpire()
    {
        return $this->sandboxExpire;
    }

    /**
     * VIP容量，单位B
     * @return int
     */
    public function getChargeSize()
    {
        return $this->chargeSize;
    }

    /**
     * 购买数量
     * @return int
     */
    public function getBuyCount()
    {
        return $this->buyCount;
    }

    /**
     * 排序
     * @return int
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * 是否隐藏，0：不隐藏，1：隐藏
     * @return int
     */
    public function getHidden()
    {
        return $this->hidden;
    }

    /**
     * 套餐状态,0:禁用，1：启用
     * @return int
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * 1：推荐
     * @return int
     */
    public function getIsRecommend()
    {
        return $this->isRecommend;
    }

    /**
     * 商品描述信息
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * 创建时间
     * @return string
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * 版本
     * @return int
     */
    public function getVer()
    {
        return $this->ver;
    }

}
