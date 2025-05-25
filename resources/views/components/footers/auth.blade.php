<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<footer class="footer py-4">
    <style>
        .footer {
            background: transparent;
            border-top: 1px solid #ddd;
            font-size: 0.85rem;
        }

        .footer i.fas.fa-heart {
            color: red;
            animation: pulse 1.2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }

        .footer a {
            color: #6c757d;
            text-decoration: none;
            margin-left: 15px;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: #0d6efd;
            text-decoration: underline;
        }

        .footer .footer-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        @media (min-width: 768px) {
            .footer .footer-container {
                flex-direction: row;
                justify-content: space-between;
            }
        }
    </style>

    <div class="container footer-container">
        <div class="text-muted mb-2 mb-md-0">
            © 2025, made with <i class="fas fa-heart"></i>
            by <strong class="text-dark">TRACER STUDY POLINEMA & TIM</strong>
        </div>
        <div class="links mt-2 mt-md-0">
            <a href="#">About Us</a>
            <a href="#">Blog</a>
            <a href="#">Contact</a>
        </div>
    </div>
</footer>
