<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationStatusNotification extends Notification
{
    use Queueable;
    protected $status;
    protected $car;

    /**
     * Create a new notification instance.
     */
    public function __construct($status, $car)
    {
        $this->status = $status;
        $this->car = $car;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->line('تم ' . $this->status . ' حجزك لسيارة ' . $this->car->brand . ' ' . $this->car->model)
        ->action('عرض الحجز', url('/reservations/' . $this->car->id))
        ->line('شكراً لاستخدامك خدمتنا!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'status' => $this->status,
            'car_id' => $this->car->id,
            'message' => 'تم ' . $this->status . ' حجزك لسيارة ' . $this->car->brand . ' ' . $this->car->model,
        ];
    }
}
