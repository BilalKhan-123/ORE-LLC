<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Access Forbidden</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .error-container {
            text-align: center;
            background: white;
            padding: 60px 40px;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            animation: slideIn 0.6s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-code {
            font-size: 120px;
            font-weight: 800;
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
            line-height: 1;
        }

        .error-title {
            font-size: 32px;
            color: #333;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .error-message {
            font-size: 16px;
            color: #666;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .error-icon {
            font-size: 80px;
            margin-bottom: 20px;
        }

        .button-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 12px 30px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(250, 112, 154, 0.4);
        }

        .btn-secondary {
            background: #f5f5f5;
            color: #333;
            border: 2px solid #fa709a;
        }

        .btn-secondary:hover {
            background: #fa709a;
            color: white;
        }

        .error-details {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid #eee;
        }

        .detail-item {
            display: inline-block;
            margin: 0 20px;
            color: #999;
            font-size: 14px;
        }

        .detail-item strong {
            color: #333;
        }

        @media (max-width: 576px) {
            .error-container {
                padding: 40px 20px;
            }

            .error-code {
                font-size: 80px;
            }

            .error-title {
                font-size: 24px;
            }

            .button-group {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }

            .detail-item {
                display: block;
                margin: 10px 0;
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-icon">🚫</div>
        <div class="error-code">403</div>
        <h1 class="error-title">Access Forbidden</h1>
        <p class="error-message">
            You don't have permission to access this resource. If you believe this is a mistake, please contact our support team.
        </p>

        <div class="button-group">
            <a href="{{ route('home') }}" class="btn btn-primary">Go to Home</a>
            <button onclick="window.history.back()" class="btn btn-secondary">Go Back</button>
        </div>

        <div class="error-details">
            <div class="detail-item">
                <strong>Status:</strong> 403 Forbidden
            </div>
            <div class="detail-item">
                <strong>Timestamp:</strong> {{ date('Y-m-d H:i:s') }}
            </div>
        </div>
    </div>
</body>
</html>
