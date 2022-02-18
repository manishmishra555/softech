<div class="section half-height">
				
				<div class="parallax-contact"></div>
				
				<div class="hero-wrap-pages">
					<div class="container">
						<div class="twelve columns">
							<h2>Appointment</h2>
							<p>Get in touch</p>	
						</div>
					</div>
				</div>					
			</div>
				
			<div class="section padding-top-bottom-med white-background">
				<div class="container">
					<div class="twelve columns">
						<div class="title-text-center">
							<h4>Book Appointment</h4>
							<p>You’re always welcome.</p>
						</div>
					</div>
 				</div>	
			</div>
			
				<div class="clear"></div>
					
				<div class="section padding-bottom-med white-background">
					<div class="container">	
							<form name="ajax-form" id="ajax-form" action="<?= site_url('appointment/submit');?>" method="post">
								<div class="four columns remove-top">
									<label for="name"> 
										Name:<span class="error" id="err-name">(please enter name)</span>
									</label>
									<input name="name" id="name" type="text" placeholder="Your Name: *"/>
								</div>
								<div class="four columns remove-top">
									<label for="email">
										Email: 
										<span class="error" id="err-email"> (please enter e-mail)</span>
										<span class="error" id="err-emailvld">(e-mail is not a valid format)</span>
									</label>
									<input name="email" id="email" type="text"  placeholder="E-Mail: *"/>
								</div>
								<div class="four columns remove-top">
									<label for="phone">
										Phone: <span class="error" id="err-phone">  ( please enter e-mail)</span>
  									</label>
									<input name="phone" id="phone" type="text"  placeholder="Phone: *"/>
								</div>

								<div class="four columns">
									<label for="appointment_date"> 
										Appointment Date: <span class="error" id="err-appointment_date"> ( please select appointment Date )</span> 
 									</label>								
									<input name="appointment_date" id="appointment_date" type="text" class="date-picker" placeholder="Appointment Date: *"/>
								 </div>
								 
								<div class="four columns">
									<label for="appointment_time"> 
										Appointment Time: <span class="error" id="err-appointment_time"> ( please select appointment )</span> 
 									</label>
									<select name="appointment_time" id="appointment_time" required>
										<option value="">Select timeslot</option>
										<option value="9AM-12PM">9 AM- 12 PM</option>
										<option value="2PM-4PM">2PM-4PM</option>
										<option value="4PM-7PM">4PM-7PM</option>
									</select>
 								</div>

								<div class="twelve columns">
									<label for="message"></label>
									<textarea name="message" id="message" placeholder="Your message"></textarea>
								</div>
								<div class="twelve columns">
									<div id="button-con"><button class="send_message button-effect button--moema button--text-thick button--text-upper button--size-s" id="appointment" data-lang="en">submit</button></div>					
								</div>
								<div class="clear"></div>	
								<div class="error text-align-center" id="err-form">There was a problem validating the form please check!</div>
								<div class="error text-align-center" id="err-timedout">The connection to the server timed out!</div>
								<div class="error" id="err-state"></div>
							</form>	
								
							<div class="clear"></div>
							<div id="ajaxsuccess" class="text-center">Successfully sent!!</div>
							<div class="clear"></div>	
					</div>	
				</div>
					
				<div class="clear"></div>		
					
				
		 