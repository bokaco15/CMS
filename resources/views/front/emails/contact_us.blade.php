<div style="font-family: Arial, Helvetica, sans-serif; background: #f6f7fb; padding: 30px;">
    <div style="max-width: 620px; margin: 0 auto; background: #ffffff; border-radius: 14px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">

        <!-- Header -->
        <div style="background: linear-gradient(135deg, #0f172a, #1e293b); padding: 26px 28px;">
            <h2 style="margin: 0; color: #ffffff; font-size: 22px; letter-spacing: 0.3px;">
                📩 Nova poruka sa kontakt forme
            </h2>
            <p style="margin: 8px 0 0; color: rgba(255,255,255,0.75); font-size: 14px;">
                Stigla je nova poruka od korisnika preko sajta.
            </p>
        </div>

        <!-- Body -->
        <div style="padding: 26px 28px; color: #111827;">
            <h3 style="margin: 0 0 12px; font-size: 18px;">
                Pozdrav, poruka od: <span style="color:#2563eb;">{{ $name }}</span>
            </h3>

            <div style="background: #f3f4f6; border: 1px solid #e5e7eb; padding: 16px 18px; border-radius: 12px; margin: 14px 0;">
                <p style="margin: 0; font-size: 15px; line-height: 1.7; color: #111827; white-space: pre-line;">
                    {{ $text_message }}
                </p>
            </div>

            <p style="margin: 16px 0 0; font-size: 13px; line-height: 1.6; color: #6b7280;">
                ⚠️ Napomena: Ovo je automatska poruka sa kontakt forme.
                Odgovorite direktno korisniku ako imate njegov email.
            </p>
        </div>

        <!-- Footer -->
        <div style="padding: 18px 28px; background: #f9fafb; border-top: 1px solid #e5e7eb;">
            <p style="margin: 0; font-size: 13px; color: #6b7280;">
                Pozdrav! 👋<br>
                <strong style="color:#111827;">Sistem notifikacija</strong>
            </p>
        </div>

    </div>
</div>
