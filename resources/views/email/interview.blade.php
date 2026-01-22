<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f1f5f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            margin-top: 40px;
            margin-bottom: 40px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            padding: 40px 20px;
            text-align: center;
        }

        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        .content {
            padding: 40px 30px;
            color: #334155;
            line-height: 1.6;
        }

        .info-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            margin: 20px 0;
        }

        .info-item {
            margin-bottom: 10px;
        }

        .info-label {
            font-size: 12px;
            color: #64748b;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 16px;
            color: #1e293b;
            font-weight: 600;
        }

        .btn {
            display: inline-block;
            background-color: #4f46e5;
            color: #ffffff;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: bold;
            margin-top: 20px;
        }

        .footer {
            background-color: #f8fafc;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Undangan Interview</h1>
            <p style="color: #e0e7ff; margin-top: 5px; font-size: 14px;">KarirKu Notification System</p>
        </div>

        <div class="content">
            <p>Halo <strong>{{ $application->name }}</strong>,</p>

            <p>Selamat! Lamaran Anda untuk posisi <strong>{{ $application->job->title }}</strong> telah menarik perhatian kami. Kami ingin mengundang Anda untuk mengikuti sesi interview.</p>

            <p style="margin-top:20px;"><em>"{{ $pesan }}"</em></p>

            <div class="info-box">
                <div class="info-item">
                    <div class="info-label">Waktu Interview</div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($date)->isoFormat('dddd, D MMMM Y') }}</div>
                    <div class="info-value" style="font-size:14px; color:#4f46e5;">Pukul {{ \Carbon\Carbon::parse($date)->format('H:i') }} WIB</div>
                </div>
                <div class="info-item" style="margin-top:15px; margin-bottom:0;">
                    <div class="info-label">Perusahaan</div>
                    <div class="info-value">{{ $application->job->company_name ?? 'Perusahaan Kami' }}</div>
                </div>
            </div>

            <div style="text-align: center;">
                <a href="{{ route('email.confirmed', $application->id) }}" class="btn">
                    Konfirmasi Kehadiran
                </a>
            </div>

            <p style="margin-top: 30px; font-size: 14px; color: #64748b;">
                Mohon hadir tepat waktu. Jika Anda berhalangan hadir, harap membalas email ini sesegera mungkin.
            </p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} KarirKu Job Portal. All rights reserved.</p>
        </div>
    </div>
</body>

</html>