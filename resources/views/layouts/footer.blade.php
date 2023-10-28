        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>{{ date('Y') }} &copy; Copy Right
                        <a href="https://www.mkisol.com" target="_blank">MKISOL</a>
                    </p>
                </div>
                <div class="float-end">
                    <p>Admin by
                        <a href="https://www.mkisol.com" target="_blank">Wedding Hall</a>
                    </p>
                </div>
            </div>
        </footer>
    </div>

    <script src="{{ asset('mazer') }}/js/app.js"></script>
    <script src="{{ asset('mazer') }}/js/pages/choices.js"></script>
    <script src="{{ asset('mazer') }}/js/pages/form-element-select.js"></script>
    @stack('js')
</body>

</html>
