<?php

namespace App\Services\Core;

use App\Models\EmailTemplate;
use Illuminate\Support\Str;

class EmailService extends BaseService
{
    /**
     * Render an email template by slug.
     */
    public function render(string $slug, array $data = []): array
    {
        $template = EmailTemplate::where('slug', $slug)->first();

        if (!$template) {
            return [
                'subject' => 'Notification',
                'body' => 'No template found for ' . $slug,
            ];
        }

        $subject = $this->parse($template->subject, $data);
        $body = $this->parse($template->body_html, $data);

        return [
            'subject' => $subject,
            'body' => $body,
        ];
    }

    /**
     * Simple string replacement for {{ key }}.
     */
    protected function parse(string $content, array $data): string
    {
        foreach ($data as $key => $value) {
            $content = str_replace('{{ ' . $key . ' }}', $value, $content);
            $content = str_replace('{{' . $key . '}}', $value, $content);
        }
        return $content;
    }

    // In a real app, this would also have a send() method using Laravel Mail
}
