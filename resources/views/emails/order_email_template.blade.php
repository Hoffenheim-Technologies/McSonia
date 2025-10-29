<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#f9f9f9" id="bodyTable">
	<tbody>
		<tr>
			<td style="padding-right:10px;padding-left:10px;" align="center" valign="top" id="bodyCell">
				<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperBody" style="max-width:600px">
					<tbody>
						<tr>
							<td align="center" valign="top">
								<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableCard" style="background-color:#fff;border-color:#e5e5e5;border-style:solid;border-width:0 1px 1px 1px;">
									<tbody>
										<tr>
											<td style="background-color:#ffc400;font-size:1px;line-height:3px" class="topBorder" height="3">&nbsp;</td>
										</tr>
										<tr>
											<td style="padding-top: 20px; padding-bottom: 20px;" align="center" valign="middle" class="emailLogo">
												<a href="#" style="text-decoration:none" target="_blank">
													<img alt="" border="0" src="{{ env('APP_URL') }}/images/logo.png" style="width:100%;max-width:150px;height:auto;display:block" width="150">
												</a>
											</td>
										</tr>
										<tr>
											<td style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="mainTitle">
												<h4 class="text" style="color:#000;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:18px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:36px;text-transform:none;text-align:center;padding:0;margin:0">Hello {{$details['name']}}</h4>
											</td>
										</tr>
										<tr>
											<td style="padding-bottom: 30px; padding-left: 20px; padding-right: 20px;" align="left" valign="top" class="subTitle">
												<h4 class="text" style="color:#999;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:16px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:24px;text-transform:none;text-align:center;padding:0;margin:0">
                                                    {{-- Email Title --}}
                                                    {{$details['title']}}
                                                </h4>
											</td>
										</tr>
										<tr>
											<td style="padding-left:20px;padding-right:20px" align="center" valign="top" class="containtTable ui-sortable">
												<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableDescription" style="">
													<tbody>
														<tr>
															<td style="padding-bottom: 20px; margin-top:40px" align="left" valign="top" class="description">
																<p class="text" style="color:#666;font-family:'Open Sans',Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:22px;text-transform:none;text-align:center;padding:0;margin:0">
                                                                 {{-- Email Body --}}
                                                                 {{$details['body']}}
                                                                </p>
															</td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
										<tr>
											<td style="padding-left:20px;padding-right:20px" align="center" valign="top" class="containtTable ui-sortable">
												<table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableDescription" style="">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                Pickup Information
                                                            </th>
                                                            <th>
                                                                Dropoff Information
                                                            </th>
                                                        </tr>
                                                    </thead>
													<tbody>
														<tr>
															<td style="padding-bottom: 20px; margin-top:40px" align="left" valign="top" class="description">
																<p class="text" style="color:#666;font-family:'Open Sans',Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:22px;text-transform:none;text-align:center;padding:0;margin:0">
                                                                    Location: {{$details['location']->plocation}} <br>
                                                                    Address: {{$details['location']->paddress}}
                                                                </p>
															</td>
															<td style="padding-bottom: 20px; margin-top:40px" align="left" valign="top" class="description">
																<p class="text" style="color:#666;font-family:'Open Sans',Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:22px;text-transform:none;text-align:center;padding:0;margin:0">
                                                                    Location: {{$details['location']->dlocation}} <br>
                                                                    Address: {{$details['location']->daddress}}
                                                                </p>
															</td>
														</tr>
                                                        <tr>
                                                            <td colspan="2" syle="padding-bottom: 20px; margin-top:40px" align="left" valign="top" class="description">
                                                                <h5>Description</h5>
                                                                {{$details['description']}}
                                                            </td>
                                                        </tr>
													</tbody>
												</table>
											</td>
										</tr>
										<tr>
											<td style="font-size:1px;line-height:1px" height="20">&nbsp;</td>
										</tr>
									</tbody>
								</table>
								<table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
									<tbody>
										<tr>
											<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
				<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperFooter" style="max-width:600px">
					<tbody>
						<tr>
							<td align="center" valign="top">
								<table border="0" cellpadding="0" cellspacing="0" width="100%" class="footer">
									<tbody>
										<tr>
											<td style="padding: 10px 10px 5px;" align="center" valign="top" class="brandInfo">
												<p class="text" style="color:#bbb;font-family:'Open Sans',Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0">&copy; {{ now()->year }} &nbsp;McSonia </p>
											</td>
										</tr>
										<tr>
											<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>
