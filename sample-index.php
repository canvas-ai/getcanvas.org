<?php
// Check server status
function checkServerStatus() {
    $ch = curl_init('https://my.cnvs.ai/rest/ping');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    return $httpCode === 200;
}

$isOnline = checkServerStatus();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canvas | Contextualize your unstructured Universe!</title>
    
    <!-- React and ReactDOM -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/18.2.0/umd/react.production.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react-dom/18.2.0/umd/react-dom.production.min.js"></script>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
</head>
<body class="bg-gray-50">
    <div id="root"></div>

    <script type="text/javascript">
        const isOnline = <?php echo json_encode($isOnline); ?>;
        
        function StatusPage() {
            const [status] = React.useState(isOnline);

            return React.createElement('div', {
                className: 'min-h-screen flex items-center justify-center p-4'
            }, 
                React.createElement('div', {
                    className: 'flex flex-col items-center'
                }, [
                    // Main Card
                    React.createElement('div', {
                        className: 'bg-white rounded-lg border border-gray-200 shadow-md w-80'
                    }, 
                        React.createElement('div', {
                            className: 'p-6 flex flex-col items-center space-y-6'
                        }, [
                            // Logo
                            React.createElement('img', {
                                src: 'https://raw.githubusercontent.com/canvas-ai/canvas-server/refs/heads/main/src/ui/assets/images/logo_1024x1024_v2.png',
                                alt: 'Canvas Logo',
                                className: 'w-64 h-64 object-contain'
                            }),
                            
                            // Status Text
                            React.createElement('div', {
                                className: 'flex items-center space-x-2'
                            }, [
                                React.createElement('span', {
                                    className: 'text-lg'
                                }, 'Canvas status: '),
                                React.createElement('div', {
                                    className: `w-5 h-5 ${status ? 'text-green-500' : 'text-red-500'}`
                                }, status ? '✓' : '✕'),
                                React.createElement('span', {
                                    className: status ? 'text-green-500' : 'text-red-500'
                                }, status ? 'Online' : 'Offline')
                            ]),
                            
                            // Enter Button
                            React.createElement('button', {
                                className: `w-full px-4 py-2 text-sm font-medium text-white bg-black rounded-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 ${!status && 'opacity-50 cursor-not-allowed'}`,
                                onClick: () => {
                                    if (status) {
                                        window.location.href = 'https://my.cnvs.ai/';
                                    }
                                },
                                disabled: !status
                            }, 'Enter My Universe | ∞')
                        ])
                    ),
                    
                    // GitHub Link
                    React.createElement('a', {
                        href: 'https://github.com/canvas-ai',
                        target: '_blank',
                        className: 'mt-4 text-gray-600 hover:text-gray-900 flex items-center space-x-2',
                        rel: 'noopener noreferrer'
                    }, [
                        // GitHub Icon (SVG)
                        React.createElement('svg', {
                            viewBox: '0 0 24 24',
                            width: '24',
                            height: '24',
                            stroke: 'currentColor',
                            fill: 'none',
                            strokeWidth: '2',
                            strokeLinecap: 'round',
                            strokeLinejoin: 'round',
                            className: 'w-6 h-6'
                        }, [
                            React.createElement('path', {
                                d: 'M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22'
                            })
                        ]),
                        React.createElement('span', {}, 'GitHub')
                    ])
                ])
            );
        }

        const root = ReactDOM.createRoot(document.getElementById('root'));
        root.render(React.createElement(StatusPage));
    </script>	
</body>
</html>
