<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>

        body {
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .certificate {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border: 5px solid #2a9d8f;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .certificate-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .certificate-header img {
            width: 80px;
            margin-bottom: 20px;
        }
        .certificate-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2a9d8f;
            margin: 0;
        }
        .certificate-subtitle {
            font-size: 1.5rem;
            margin: 10px 0;
        }
        .certificate-body {
            font-size: 1.2rem;
            line-height: 1.6;
            text-align: center;
            margin: 20px 0;
        }
        .certificate-footer {
            text-align: center;
            margin-top: 30px;
        }
        .certificate-footer p {
            font-size: 1rem;
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <div class="certificate-header">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT8cypZp9xQE-ifK8deGkwkqDz3N8rDvxZ_EA&s" alt="Company Logo">
            <h1 class="certificate-title">Certificate of Appreciation</h1>
            <p class="certificate-subtitle">Presented To</p>
        </div>

        <div class="certificate-body">
            <p><strong>{{ auth()->user()->name }}</strong></p>
            <p>For your generous donation of ${{ number_format($amount, 2) }}</p>
            <p>to the campaign <strong>{{ $campaign->title }}</strong>.</p>
            <p>Your support is invaluable and greatly appreciated.</p>
        </div>

        <div class="certificate-footer">
            <p>Issued on: {{ $campaign->donations[0]->created_at->format('Y-m-d h:i A') }}</p>
            <p>Campaign Owner: {{ $campaign->user->name }}</p>
            <p>Thank you for making a difference!</p>
        </div>
    </div>
</body>
</html>
