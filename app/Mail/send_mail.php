<?php

namespace App\Mail;

use App\Models\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class send_mail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    private $course;
    private $id_course;
    public function __construct(Course $course, $id_course)
    {
        $this->course = $course;
        $this->id_course = $id_course;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Đăng kí thành công',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $course= $this->course->where('id', $this->id_course)->get();

        return new Content(
            view: 'send_mail',
            with: [
                'course' => $course,
                
            ],
           

        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
           
        ];
    }
}
