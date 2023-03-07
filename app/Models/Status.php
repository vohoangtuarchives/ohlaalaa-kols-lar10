<?php
namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Support\Traits\ForwardsCalls;

class Status extends Collection{

    use ForwardsCalls;
    public const CUSTOMERS = 'customers';
    public const USERS = 'users';

    public const CAMPAIGNS = 'campaigns';





    /**
     * //https://woocommerce.com/document/managing-orders/#order-statuses
     * Pending payment — Order received, no payment initiated. Awaiting payment (unpaid).
     * Failed — Payment failed or was declined (unpaid) or requires authentication (SCA). Note that this status may not show immediately and instead show as Pending until verified (e.g., PayPal).
     * Processing — Payment received (paid) and stock has been reduced; order is awaiting fulfillment. All product orders require processing, except those that only contain products which are both Virtual and Downloadable.
     * Completed — Order fulfilled and complete – requires no further action.
     * On hold — Awaiting payment – stock is reduced, but you need to confirm payment.
     * Cancelled — Cancelled by an admin or the customer – stock is increased, no further action required.
     * Please note: This status does not refund the customer.
     * An example use case: The merchant wants to cancel the order because the customer has become unresponsive and they do not know where to ship the product. The customer is not eligible for a refund in this case.
     * To issue a refund please follow the Manage refunds documentation.
     * Refunded — Refunded by an admin – no further action required.
     * Authentication required — Awaiting action by the customer to authenticate the transaction and/or complete SCA requirements.
     * Checkout draft — Draft order created when customers start the checkout process with WooCommerce Blocks checkout block enabled.
     */
    public const DEFAULT_STATUS = ['pending', 'failed', 'processing', 'completed', 'on_hold', 'canceled', 'refunded', 'draf'];

    public const PENDING = 'pending';
    public const FAILED = 'failed';
    public const PROCESSING = 'processing';
    public const COMPLETED = 'completed';
    public const ON_HOLD = 'on_hold';
    public const CANCELED = 'canceled';
    public const REFUNDED = 'refunded';
    public const DRAF = 'draf';

    public const CUSTOMER_ACTIVE = 'active';

    public const CUSTOMER_UNACTIVE = 'unactive';

    public const CUSTOMER_BANNED = 'banned';

    public const CUSTOMER_STATUS = [self::PENDING, self::COMPLETED];

    protected $users = [self::PENDING, self::PROCESSING, self::COMPLETED, self::CANCELED, self::REFUNDED];

    protected $campaigns = [];



    public function isPendding(){
        return $this->status == self::PENDING;
    }

    public function isFailed(){
        return $this->status == self::FAILED;
    }

    public function isProcessing(){
        return $this->status == self::PROCESSING;
    }

    public function isCompleted(){
        return $this->status == self::COMPLETED;
    }

    public function isOnHold(){
        return $this->status == self::ON_HOLD;
    }

    public function isCanceled(){
        return $this->status == self::CANCELED;
    }

    public function isRefunded(){
        return $this->status == self::REFUNDED;
    }

    public function isDRARF(){
        return $this->status == self::DRAF;
    }

}