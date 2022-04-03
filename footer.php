<footer class="footer">
        <div class="container">
            <div class="footer__logo">
				<?php
					$custom_logo__url = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' ); 
				?>
				<img src="<?php echo $custom_logo__url[0];  ?>" alt="footer__logo--image">
            </div>
            <?php
            $right_column = $footer['right_column'];
            ?>
           <div class="footer__content">
			<div class="footer__content--container">
					<div class="footer__content--menu">
							<p>
									Bowen Theory Academy
							</p>
							<ul>
									<li>
											<a href="#">About</a>
									</li>
									<li>
											<a href="#">Our Work</a>
									</li>
									<li>
											<a href="#">Events &amp; Webinars Registration</a>
									</li>
									<li>
											<a href="#">Past Webinars</a>
									</li>
									<li>
											<a href="#">News</a>
									</li>
							</ul>
					</div>
					<div class="footer__content--contacts">
							<p>
									Contact Us
							</p>
							<div class="footer__content--mail">
									<a href="mailto:hello@bowen.com">hello@bowen.com</a>
									<ul class="footer__content--social">
											<li>
													<a href="https://twitter.com/">
													<svg width="32" height="33" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M16 0.476562C7.16429 0.476562 0 7.64085 0 16.4766C0 25.3123 7.16429 32.4766 16 32.4766C24.8357 32.4766 32 25.3123 32 16.4766C32 7.64085 24.8357 0.476562 16 0.476562ZM23.6893 12.5373C23.7 12.7051 23.7 12.8801 23.7 13.0516C23.7 18.2944 19.7071 24.3337 12.4107 24.3337C10.1607 24.3337 8.075 23.6801 6.31786 22.5551C6.63929 22.5908 6.94643 22.6051 7.275 22.6051C9.13214 22.6051 10.8393 21.9766 12.2 20.9123C10.4571 20.8766 8.99286 19.7337 8.49286 18.1623C9.10357 18.2516 9.65357 18.2516 10.2821 18.0908C9.38474 17.9085 8.57812 17.4211 7.99934 16.7115C7.42056 16.0019 7.10531 15.1137 7.10714 14.198V14.148C7.63214 14.4444 8.25 14.6266 8.89643 14.6516C8.35301 14.2894 7.90735 13.7987 7.59897 13.2231C7.29059 12.6475 7.12901 12.0046 7.12857 11.3516C7.12857 10.6123 7.32143 9.93728 7.66786 9.35156C8.66394 10.5778 9.9069 11.5806 11.3159 12.295C12.725 13.0094 14.2686 13.4193 15.8464 13.498C15.2857 10.8016 17.3 8.61942 19.7214 8.61942C20.8643 8.61942 21.8929 9.09799 22.6179 9.86942C23.5143 9.70156 24.3714 9.36585 25.1357 8.91585C24.8393 9.8337 24.2179 10.6087 23.3929 11.098C24.1929 11.0123 24.9643 10.7908 25.6786 10.4801C25.1393 11.273 24.4643 11.9766 23.6893 12.5373Z" fill="white"></path>
													</svg>
													</a>
											</li>
											<li>
													<a href="http://linkedin.com">
													<svg width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M16.5625 0C7.72583 0 0.5625 7.16333 0.5625 16C0.5625 24.8367 7.72583 32 16.5625 32C25.3992 32 32.5625 24.8367 32.5625 16C32.5625 7.16333 25.3992 0 16.5625 0ZM12.6458 22.6317H9.40583V12.205H12.6458V22.6317ZM11.0058 10.925C9.9825 10.925 9.32083 10.2 9.32083 9.30333C9.32083 8.38833 10.0025 7.685 11.0475 7.685C12.0925 7.685 12.7325 8.38833 12.7525 9.30333C12.7525 10.2 12.0925 10.925 11.0058 10.925ZM24.4792 22.6317H21.2392V16.8533C21.2392 15.5083 20.7692 14.595 19.5975 14.595C18.7025 14.595 18.1708 15.2133 17.9358 15.8083C17.8492 16.02 17.8275 16.32 17.8275 16.6183V22.63H14.5858V15.53C14.5858 14.2283 14.5442 13.14 14.5008 12.2033H17.3158L17.4642 13.6517H17.5292C17.9558 12.9717 19.0008 11.9683 20.7492 11.9683C22.8808 11.9683 24.4792 13.3967 24.4792 16.4667V22.6317Z" fill="white"></path>
													</svg>
													</a>
											</li>
									</ul>
							</div>
							<div class="footer__content--btn">
									<a href="#">Contact Us</a>
							</div>
					</div>
			</div>
			<div class="footer__private">
                <p>
                        Bowen Theory Academy © 2022 All rights reserved
                </p>
                <p>
                        Website Design by:
                        <a href="https://weareimmediate.com/">We Are Immediate</a>
                </p>
        	</div>
			</div>

        </div>
    </footer>

</div>

<?php wp_footer(); ?>

</body>
</html>
