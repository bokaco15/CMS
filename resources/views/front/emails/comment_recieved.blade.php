<div style="font-family: Arial, Helvetica, sans-serif; background: #f6f7fb; padding: 30px;">
    <div style="max-width: 620px; margin: 0 auto; background: #ffffff; border-radius: 14px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">

        <div style="background: linear-gradient(135deg, #111827, #1f2937); padding: 26px 28px;">
            <h2 style="margin: 0; color: #ffffff; font-size: 22px; letter-spacing: 0.3px;">
                Komentar uspješno primljen
            </h2>
            <p style="margin: 8px 0 0; color: rgba(255,255,255,0.75); font-size: 14px;">
                Hvala što učestvujete — vaš komentar je na čekanju za odobrenje.
            </p>
        </div>

        <div style="padding: 26px 28px; color: #111827;">
            <h3 style="margin: 0 0 10px; font-size: 18px;">
                Pozdrav, <span style="color:#2563eb;">{{ $comment->name }}</span>
            </h3>

            <p style="margin: 0 0 16px; font-size: 15px; line-height: 1.6; color: #374151;">
                Uspješno smo primili vaš komentar.
                Molimo vas da sačekate par dana dok naš tim ne pregleda i odobri komentar.
            </p>

            <div style="background: #f3f4f6; border: 1px solid #e5e7eb; padding: 14px 16px; border-radius: 12px; margin: 18px 0;">
                <p style="margin: 0; font-size: 14px; line-height: 1.6; color: #111827;">
                    Status: <strong style="color:#b45309;">Na čekanju</strong><br>
                    Bićete obaviješteni čim komentar bude odobren.
                </p>
            </div>

            <!-- Button -->
            <div style="text-align: center; margin: 22px 0 10px;">
                <a href="{{ $url }}"
                   style="display: inline-block; background: #2563eb; color: #ffffff; text-decoration: none; padding: 12px 18px; border-radius: 10px; font-weight: bold; font-size: 15px;">
                     Pogledaj objavu koju ste komentarisali
                </a>
            </div>

            <p style="margin: 14px 0 0; font-size: 13px; line-height: 1.6; color: #6b7280;">
                Ako dugme ne radi, kopirajte i zalijepite ovaj link u browser:<br>
                <span style="color:#2563eb; word-break: break-all;">{{ $url }}</span>
            </p>
        </div>

        <!-- Footer -->
        <div style="padding: 18px 28px; background: #f9fafb; border-top: 1px solid #e5e7eb;">
            <p style="margin: 0; font-size: 13px; color: #6b7280;">
                Pozdrav! <br>
                <strong style="color:#111827;">Vaš tim</strong>
            </p>
        </div>
    </div>
</div>
