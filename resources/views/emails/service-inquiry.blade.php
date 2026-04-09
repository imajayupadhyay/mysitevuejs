<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>New Service Inquiry</title>
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
              <h1 style="margin:0;color:#f1ede3;font-size:24px;font-weight:700;letter-spacing:-0.02em;">New Service Inquiry</h1>
              <p style="margin:8px 0 0;color:#9c978b;font-size:13px;">A potential client submitted a service request.</p>
            </td>
          </tr>

          {{-- Service badge --}}
          <tr>
            <td style="background-color:#111118;padding:16px 36px;border-bottom:1px solid #26262f;">
              <table cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td style="background-color:#ff9544;border-radius:20px;padding:5px 14px;">
                    <span style="font-family:'Courier New',monospace;font-size:11px;font-weight:700;color:#1a0f08;letter-spacing:0.08em;text-transform:uppercase;">{{ $inquiry->service }}</span>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          {{-- Body --}}
          <tr>
            <td style="background-color:#ffffff;padding:32px 36px;">

              {{-- Two-column: Name + Email --}}
              <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:16px;">
                <tr>
                  <td width="48%" style="background-color:#f8f7f5;border-radius:8px;border:1px solid #e5e2dc;padding:14px 18px;vertical-align:top;">
                    <p style="margin:0 0 4px;font-family:'Courier New',monospace;font-size:10px;letter-spacing:0.12em;text-transform:uppercase;color:#9c978b;">Name</p>
                    <p style="margin:0;font-size:15px;font-weight:600;color:#1a1a1a;">{{ $inquiry->name }}</p>
                  </td>
                  <td width="4%"></td>
                  <td width="48%" style="background-color:#f8f7f5;border-radius:8px;border:1px solid #e5e2dc;padding:14px 18px;vertical-align:top;">
                    <p style="margin:0 0 4px;font-family:'Courier New',monospace;font-size:10px;letter-spacing:0.12em;text-transform:uppercase;color:#9c978b;">Email</p>
                    <a href="mailto:{{ $inquiry->email }}" style="font-family:'Courier New',monospace;font-size:12px;color:#ff9544;text-decoration:none;word-break:break-all;">{{ $inquiry->email }}</a>
                  </td>
                </tr>
              </table>

              @if($inquiry->phone || $inquiry->company)
              {{-- Two-column: Phone + Company --}}
              <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:16px;">
                <tr>
                  @if($inquiry->phone)
                  <td width="48%" style="background-color:#f8f7f5;border-radius:8px;border:1px solid #e5e2dc;padding:14px 18px;vertical-align:top;">
                    <p style="margin:0 0 4px;font-family:'Courier New',monospace;font-size:10px;letter-spacing:0.12em;text-transform:uppercase;color:#9c978b;">Phone</p>
                    <p style="margin:0;font-family:'Courier New',monospace;font-size:13px;color:#1a1a1a;">{{ $inquiry->phone }}</p>
                  </td>
                  @endif
                  @if($inquiry->phone && $inquiry->company)<td width="4%"></td>@endif
                  @if($inquiry->company)
                  <td width="{{ $inquiry->phone ? '48%' : '100%' }}" style="background-color:#f8f7f5;border-radius:8px;border:1px solid #e5e2dc;padding:14px 18px;vertical-align:top;">
                    <p style="margin:0 0 4px;font-family:'Courier New',monospace;font-size:10px;letter-spacing:0.12em;text-transform:uppercase;color:#9c978b;">Company</p>
                    <p style="margin:0;font-size:14px;font-weight:600;color:#1a1a1a;">{{ $inquiry->company }}</p>
                  </td>
                  @endif
                </tr>
              </table>
              @endif

              @if($inquiry->budget || $inquiry->timeline)
              {{-- Two-column: Budget + Timeline --}}
              <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:16px;">
                <tr>
                  @if($inquiry->budget)
                  <td width="48%" style="background-color:#fff8f0;border-radius:8px;border:1px solid #ffd4aa;padding:14px 18px;vertical-align:top;">
                    <p style="margin:0 0 4px;font-family:'Courier New',monospace;font-size:10px;letter-spacing:0.12em;text-transform:uppercase;color:#cc7a30;">Budget</p>
                    <p style="margin:0;font-size:14px;font-weight:700;color:#ff9544;">{{ $inquiry->budget }}</p>
                  </td>
                  @endif
                  @if($inquiry->budget && $inquiry->timeline)<td width="4%"></td>@endif
                  @if($inquiry->timeline)
                  <td width="{{ $inquiry->budget ? '48%' : '100%' }}" style="background-color:#f8f7f5;border-radius:8px;border:1px solid #e5e2dc;padding:14px 18px;vertical-align:top;">
                    <p style="margin:0 0 4px;font-family:'Courier New',monospace;font-size:10px;letter-spacing:0.12em;text-transform:uppercase;color:#9c978b;">Timeline</p>
                    <p style="margin:0;font-size:14px;font-weight:600;color:#1a1a1a;">{{ $inquiry->timeline }}</p>
                  </td>
                  @endif
                </tr>
              </table>
              @endif

              {{-- Details --}}
              <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td style="background-color:#f8f7f5;border-radius:8px;border:1px solid #e5e2dc;padding:14px 18px;">
                    <p style="margin:0 0 8px;font-family:'Courier New',monospace;font-size:10px;letter-spacing:0.12em;text-transform:uppercase;color:#9c978b;">Project Details</p>
                    <p style="margin:0;font-size:14px;color:#333333;line-height:1.65;white-space:pre-wrap;">{{ $inquiry->details }}</p>
                  </td>
                </tr>
              </table>

            </td>
          </tr>

          {{-- Footer --}}
          <tr>
            <td style="background-color:#0a0a0f;border-radius:0 0 12px 12px;padding:20px 36px;text-align:center;">
              <p style="margin:0;font-family:'Courier New',monospace;font-size:10px;color:#62605a;letter-spacing:0.08em;">
                Received {{ $inquiry->created_at->format('d M Y · H:i') }} · ajayupadhyay.com
              </p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>

</body>
</html>
