<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <title>Service Unavailable - DOST-SETUP</title>
    @vite('resources/css/app.scss')
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #e6f2f5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
            background-image: radial-gradient(circle, rgba(230, 242, 245, 0.7) 0%, rgba(230, 242, 245, 1) 100%);
            min-height: 100vh;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            padding: 20px;
            box-sizing: border-box;
        }

        .error-card {
            width: 100%;
            max-width: 500px;
            border: none;
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            background-color: white;
            overflow: hidden;
            margin: 0 auto;
        }

        .error-header {
            background-color: #e8f0ff;
            color: #3f51b5;
            padding: 16px;
            text-align: center;
        }

        .error-header h4 {
            margin: 0;
        }

        .card-body {
            padding: 30px;
        }

        .error-code {
            font-size: 5rem;
            font-weight: 700;
            color: #3f51b5;
            margin-bottom: 20px;
            text-align: center;
        }

        .alert-warning {
            background-color: #e8f0ff;
            border-left: 4px solid #3f51b5;
            padding: 16px;
            margin-bottom: 20px;
            border-radius: 4px;
            color: #333;
            font-weight: 500;
            text-align: center;
        }

        .status-indicator {
            display: inline-block;
            width: 10px;
            height: 10px;
            background-color: #3f51b5;
            border-radius: 50%;
            margin-right: 8px;
            animation: pulse 2s infinite;
        }

        .maintenance-info {
            text-align: center;
            margin-bottom: 20px;
            color: #555;
            line-height: 1.5;
        }

        .btn-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-primary {
            background-color: #2A9D8F;
            border: none;
            color: white;
            padding: 12px 24px;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.3s;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid #ccc;
            color: #666;
            padding: 12px 24px;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.3s;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #248277;
        }

        .btn-outline:hover {
            background-color: #f5f5f5;
        }

        .card-footer {
            padding: 16px;
            border-top: 1px solid #eee;
            color: #777;
            font-size: 0.8rem;
            text-align: center;
        }

        @keyframes pulse {
            0% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(63, 81, 181, 0.7);
            }

            70% {
                transform: scale(1);
                box-shadow: 0 0 0 5px rgba(63, 81, 181, 0);
            }

            100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(63, 81, 181, 0);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="error-card">
            <div class="error-header">
                <h4>System Maintenance</h4>
            </div>
            <div class="card-body">
                <div class="error-code">503</div>
                <div class="alert-warning">
                    <span class="status-indicator"></span>
                    Service Temporarily Unavailable
                </div>
                <div class="maintenance-info">
                    <p>We're currently performing scheduled maintenance on our system to improve your experience.</p>
                    <p>Please check back soon. We apologize for any inconvenience this may cause.</p>
                    <p>Expected completion time:
                        {{ isset($exception) && method_exists($exception, 'getMessage') && $exception->getMessage() ? $exception->getMessage() : 'Soon' }}
                    </p>
                </div>
                <div class="btn-container">
                    <a
                        class="btn-primary"
                        href="javascript:location.reload()"
                    >
                        Refresh Page
                    </a>
                </div>
            </div>
            <div class="card-footer">
                <small>If you need immediate assistance, please contact the system administrator</small>
            </div>
        </div>
    </div>
</body>

</html>
