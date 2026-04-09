<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>New Contact Message</title>
</head>
<body style="margin:0;padding:0;background-color:#f0ede8;font-family:Arial,Helvetica,sans-serif;">

  <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f0ede8;padding:40px 16px;">
    <tr>
      <td align="center">
        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="max-width:580px;">

          {{-- Header --}}
          <tr>
            <td style="background-color:#0a0a0f;border-radius:12px 12px 0 0;padding:32px 36px 28px;border-bottom:2px solid #ff9544;">
              <p style="margin:0 0 10px;font-family:'Courier New',monospace;font-size:10px;letter-spacing:0.16em;text-transform:uppercase;color:#ff9544;">§ ajayupadhyay.com</p>
              <h1 style="margin:0;color:#f1ede3;font-size:24px;font-weight:700;letter-spacing:-0.02em;">New Contact Message</h1>
              <p style="margin:8px 0 0;color:#9c978b;font-size:13px;">Someone reached out via your portfolio site.</p>
            </td>
          </tr>

          {{-- Body --}}
          <tr>
            <td style="background-color:#ffffff;padding:32px 36px;">

              {{-- Name --}}
              <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:16px;">
                <tr>
                  <td style="background-color:#f8f7f5;border-radius:8px;border:1px solid #e5e2dc;padding:14px 18px;">
                    <p style="margin:0 0 4px;font-family:'Courier New',monospace;font-size:10px;letter-spacing:0.12em;text-transform:uppercase;color:#9c978b;">Name</p>
                    <p style="margin:0;font-size:15px;font-weight:600;color:#1a1a1a;">{{ $contact->name }}</p>
                  </td>
                </tr>
              </table>

              {{-- Email --}}
              <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:16px;">
                <tr>
                  <td style="background-color:#f8f7f5;border-radius:8px;border:1px solid #e5e2dc;padding:14px 18px;">
                    <p style="margin:0 0 4px;font-family:'Courier New',monospace;font-size:10px;letter-spacing:0.12em;text-transform:uppercase;color:#9c978b;">Email</p>
                    <a href="mailto:{{ $contact->email }}" style="font-family:'Courier New',monospace;font-size:13px;color:#ff9544;text-decoration:none;">{{ $contact->email }}</a>
                  </td>
                </tr>
              </table>

              @if($contact->phone)
              {{-- Phone --}}
              <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:16px;">
                <tr>
                  <td style="background-color:#f8f7f5;border-radius:8px;border:1px solid #e5e2dc;padding:14px 18px;">
                    <p style="margin:0 0 4px;font-family:'Courier New',monospace;font-size:10px;letter-spacing:0.12em;text-transform:uppercase;color:#9c978b;">Phone</p>
                    <p style="margin:0;font-family:'Courier New',monospace;font-size:13px;color:#1a1a1a;">{{ $contact->phone }}</p>
                  </td>
                </tr>
              </table>
              @endif

              {{-- Message --}}
              <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:8px;">
                <tr>
                  <td style="background-color:#f8f7f5;border-radius:8px;border:1px solid #e5e2dc;padding:14px 18px;">
                    <p style="margin:0 0 8px;font-family:'Courier New',monospace;font-size:10px;letter-spacing:0.12em;text-transform:uppercase;color:#9c978b;">Message</p>
                    <p style="margin:0;font-size:14px;color:#333333;line-height:1.65;white-space:pre-wrap;">{{ $contact->message }}</p>
                  </td>
                </tr>
              </table>

            </td>
          </tr>

          {{-- Footer --}}
          <tr>
            <td style="background-color:#0a0a0f;border-radius:0 0 12px 12px;padding:20px 36px;text-align:center;">
              <p style="margin:0;font-family:'Courier New',monospace;font-size:10px;color:#62605a;letter-spacing:0.08em;">
                Received {{ $contact->created_at->format('d M Y · H:i') }} · ajayupadhyay.com
              </p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>

</body>
</html>
