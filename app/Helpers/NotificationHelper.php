<?php

namespace App\Helpers;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Model;

class NotificationHelper
{

    /**
     * Store a new notification
     */
    public static function create(
        Model   $notifiable,
        string  $type,
        ?string $title = null,
        ?string $message = null,
        array   $data = []
    )
    {
        return Notification::create([
            'type' => $type,
            'title' => $title ?? self::getDefaultTitle($type),
            'message' => $message ?? self::getDefaultMessage($type, $data),
            'notifiable_type' => get_class($notifiable),
            'notifiable_id' => $notifiable->id,
            'data' => $data,
        ]);
    }

    protected static function getDefaultTitle(string $type): string
    {
        $titles = [
            'new_order' => 'New Order Received',
            'order_created' => 'Order Confirmation',
            'order_status_update' => 'Order Status Update',
            'payment_received' => 'Payment Confirmation',
        ];
        return $titles[$type] ?? 'New Notification';
    }

    protected static function getDefaultMessage(string $type, array $data = []): string
    {
        switch ($type) {
            case 'new_order':
                return sprintf(
                    "Order #%s from %s",
                    $data['order_number'] ?? '',
                    $data['customer_name'] ?? 'a customer'
                );

            case 'order_created':
                return sprintf(
                    "Your order #%s at %s has been confirmed. Total: %s",
                    $data['order_number'] ?? '',
                    $data['restaurant_name'] ?? 'the restaurant',
                    $data['total'] ?? ''
                );

            case 'order_status_update':
                return "Your order status has been updated to: " . ($data['status'] ?? '');

            case 'payment_received':
                return sprintf(
                    "Payment of %s received for order #%s",
                    $data['total'] ?? '',
                    $data['order_number'] ?? ''
                );

            default:
                return 'You have a new notification.';
        }
    }

    /**
     * Mark a notification as read
     *
     * @param int $notificationId
     * @return bool
     */
    public static function markAsRead(int $notificationId)
    {
        $notification = Notification::find($notificationId);
        if ($notification && !$notification->read_at) {
            return $notification->update(['read_at' => now()]);
        }
        return false;
    }

    /**
     * Get unread notifications for a notifiable entity
     *
     * @param Model $notifiable
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function unread(Model $notifiable)
    {
        return Notification::where('notifiable_type', get_class($notifiable))
            ->where('notifiable_id', $notifiable->id)
            ->whereNull('read_at')
            ->latest()
            ->get();
    }

    /**
     * Get all notifications for a notifiable entity
     *
     * @param Model $notifiable
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function allFor(Model $notifiable)
    {
        return Notification::where('notifiable_type', get_class($notifiable))
            ->where('notifiable_id', $notifiable->id)
            ->latest()
            ->get();
    }
}
