<?php

class Trend {

   private $WS;
   private $username    = "xmlusrmonte";
   private $password    = "TrendV4@658";
   private $accessCode  = "400111";
   private $endPointManageToken= "http://soa.stg-1.trendoperadora.com.br/Security/v4_0/Resources/wsdl/TokenManager/CreateToken";
   private $endPointProductSearch= "http://soa.stg-1.trendoperadora.com.br/soa/sales/productsearch/v4_0/ProductSearch";
   private $endPointProductSearchDetail= "http://soa.stg-1.trendoperadora.com.br/soa/sales/productsearch/v4_0/ProductSearch/ProductDetail";
   private $endPointProductSearchFilter = "http://soa.stg-1.trendoperadora.com.br/soa/sales/productsearch/v4_0/SearchFilter";
   private $endPointBooking ="http://soa.stg-1.trendoperadora.com.br/soa/sales/booking/v4_0/Booking";



   Public  $request     = "";
   Public  $response    = "";
   Public  $erro;

   private  $securityToken = "";
   public   $transactionToken= "";
   private  $currencyCode   = '';
   private  $issuingName    = '';
   private  $email          = '';
   private  $issuerId       = '';
   private  $userName       = '';
   private  $domain         = '';
   private  $agencyId       = '';
   
   public function _construct()
   {
      
   }
   
   public function WS()
   {
      $headers = array(
         "Content-type: application/json;charset=utf-8",
         "Accept: application/json",
         "Cache-Control: no-cache",
         "Pragma: no-cache",
         "SOAPAction: \'run\'",
         "Content-length: ".strlen($this->request)
      );

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$this->endPoint);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_TIMEOUT, 60);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $this->request);
      curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');

      $data = curl_exec($ch);

      if (curl_errno($ch)) {
         print "Error: " . curl_error($ch);
         return false;
      } else {
         curl_close($ch);
         $this->response = simplexml_load_string(self::limpa_response($data));
         
         return true;
      }
   }

   public function manageToken()
   {
      $this->endPoint = $this->endPointManageToken;
      $this->request  = self::preparaXMLManageToken();

      if(self::WS())
      {
         $this->securityToken = $this->response->Body->CreateTokenRS->TokenSecurity->Token;
         $this->agencyId = $this->response->Body->CreateTokenRS->TokenSecurity->TokenDetail->attributes()[0];
         $this->domain = $this->response->Body->CreateTokenRS->TokenSecurity->TokenDetail->attributes()[1];
         $this->userName = $this->response->Body->CreateTokenRS->TokenSecurity->TokenDetail->attributes()[2];
         $this->issuerId = $this->response->Body->CreateTokenRS->TokenSecurity->TokenDetail->attributes()[3];
         $this->email = $this->response->Body->CreateTokenRS->TokenSecurity->TokenDetail->attributes()[4];
         $this->issuingName = $this->response->Body->CreateTokenRS->TokenSecurity->TokenDetail->attributes()[5];
         $this->currencyCode = $this->response->Body->CreateTokenRS->TokenSecurity->TokenDetail->attributes()[6];
         return true;
      } else {
           $this->erro = " - manageToken";
           return false;
      }
   }

   public function productSearchFilterDestines()
   {    
      $this->endPoint = $this->endPointProductSearchFilter;
      $this->request  = self::preparaXMLProductSearchFilter();

      if(self::WS())
      {
         return true;
      } else {
         $this->erro = " - productSearchFilterDestines";
         return false;
      }
   }

   public function productSearch($args)
   {    
      $this->endPoint = $this->endPointProductSearch;
      $this->request  = self::preparaXMLproductSearch($args);

      if(self::WS())
      {
         $this->transactionToken = $this->response->Body->ProductSearchRS->ProductSearchResult->HotelResult->ListHotelGroup->HotelGroup->TransactionToken;
         return true;
      } else {
         $this->erro = " - productSearch";
         return false;
      }
   }

   public function productDetail($args)
   {    
      $this->endPoint = $this->endPointProductSearchDetail;
      $this->request  = self::preparaXMLProductDetail($args);
      echo '<br>xxx2:productDetail REQUEST<br>';
      var_dump($this->request);
      if(self::WS())
      {
         return true;
      } else {
         $this->erro = " - productDetail";
         return false;
      }
   }

   public function bookingRules($args)
   {    
      $this->endPoint = $this->endPointBooking;
      $this->request  = self::preparaXMLBookingRules($args);
      echo '<br>xxx2:bookingRules REQUEST<br>';
      var_dump($this->request);      
      if(self::WS())
      {
         return true;
      } else {
         $this->erro = " - bookingRules";
         return false;
      }
   }

   public function bookingCommit($args)
   {    
      $this->endPoint = $this->endPointBooking;
      $this->request  = self::preparaXMLBookingCommit($args);

      if(self::WS())
      {
         return true;
      } else {
         $this->erro = " - bookingCommit";
         return false;
      }
   }

   public function cancellation($args)
   {    
      $this->endPoint = $this->endPointBooking;
      $this->request  = self::preparaXMLCancellation($args);

      if(self::WS())
      {
         return true;
      } else {
         $this->erro = " - cancellation";
         return false;
      }
   }
   public function preparaXMLManageToken()
   {
      return '<?xml version="1.0"?><soapenv:Envelope xmlns:sec="http://www.trendoperadora.com.br/v4_0/Security" xmlns:ser="http://www.trendoperadora.com.br/v4_0/Services" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"><soapenv:Header/><soapenv:Body><ser:CreateTokenRQ><sec:Login><sec:AccessCode>'.$this->accessCode.'</sec:AccessCode><sec:UserName>'.$this->username.'</sec:UserName><sec:Password Encrypted="false">'.$this->password.'</sec:Password></sec:Login><ser:TokenCreate UserName="'.$this->username.'"/></ser:CreateTokenRQ></soapenv:Body></soapenv:Envelope>';
   }

   private function preparaXMLproductSearch($args)
   {
      $quartos = '';
      $chds = '';

      foreach ($args['quartos'] as $key => $value) {
         foreach ($value as $key2 => $value2) {
            if(is_array($value2)){
               $chds = '<com:Guest Type="CHD" Quantity="'.count($value2).'">';
               foreach ($value2 as $key3 => $value3) {
                  $chds = $chds.'<com:Age value="'.$value3.'"/>';
               }
               $chds = $chds.'</com:Guest>';
               $quartos = str_replace('#_CHD', $chds, $quartos);
            }else{
               $quartos = str_replace('#_CHD', '', $quartos);
               $quartos = $quartos.'<com:PaxGroupCandidate><com:Guest Type="ADT" Quantity="'.$value2.'"/>#_CHD</com:PaxGroupCandidate>';
            }
         }
         $quartos = str_replace('#_CHD', '', $quartos);
      }

      return '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:sec="http://www.trendoperadora.com.br/v4_0/Security" xmlns:ser="http://www.trendoperadora.com.br/v4_0/Services" xmlns:com="http://www.trendoperadora.com.br/v4_0/Common">
   <soapenv:Header>
      <sec:Info>
         <sec:Pos Domain="'.$this->domain.'" RequestorId="'.$this->userName.'" Language = "pt-BR"/>
         <sec:Security>
            <sec:Token>'.$this->securityToken.'</sec:Token>
         </sec:Security>
      </sec:Info>
   </soapenv:Header>
   <soapenv:Body>
      <ser:ProductSearchRQ>
         <com:CommonParam SystemId="5" ClientId="'.$this->agencyId.'" AvailableOnly="true"/>
         <com:PaxCandidates>'.$quartos.'
         </com:PaxCandidates>
         <ser:SearchParams>
            <ser:ListHotelParam>
               <ser:HotelParam>
                  <com:Destination Id="'.$args['destination'].'"/>
                  <com:DateRange>
                     <com:Checkin>'.$args['checkin'].'</com:Checkin>
                     <com:Checkout>'.$args['checkout'].'</com:Checkout>
                  </com:DateRange>
               </ser:HotelParam>
            </ser:ListHotelParam>
         </ser:SearchParams>
      </ser:ProductSearchRQ>
   </soapenv:Body>
</soapenv:Envelope>';
   }

   public function preparaXMLProductDetail($args)
   {
      $productTokens = '';

      foreach ($args['productTokens'] as $key => $value) {
         $productTokens = $productTokens.'<com:ProductToken>'.$value['productToken'].'</com:ProductToken>';
      }

      return '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:sec="http://www.trendoperadora.com.br/v4_0/Security" xmlns:ser="http://www.trendoperadora.com.br/v4_0/Services" xmlns:com="http://www.trendoperadora.com.br/v4_0/Common">
   <soapenv:Header>
      <sec:Info>
         <sec:Pos Domain="'.$this->domain.'" Language="pt-BR" RequestorId="'.$this->userName.'"/>
         <sec:Security>
            <sec:Token>'.$this->securityToken.'</sec:Token>
         </sec:Security>
      </sec:Info>
   </soapenv:Header>
   <soapenv:Body>
      <ser:ProductDetailRQ>
         <ser:HotelParam>
'.$productTokens.'
         </ser:HotelParam>
      </ser:ProductDetailRQ>
   </soapenv:Body>
</soapenv:Envelope>';

   }

   public function preparaXMLBookingRules($args)
   {
      $productTokens = '';

      foreach ($args['productTokens'] as $key => $value) {
         $productTokens = $productTokens.'<com:ProductToken>'.$value['productToken'].'</com:ProductToken>';
      }

      return '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:sec="http://www.trendoperadora.com.br/v4_0/Security" xmlns:ser="http://www.trendoperadora.com.br/v4_0/Services" xmlns:hot="http://www.trendoperadora.com.br/v4_0/Hotel" xmlns:com="http://www.trendoperadora.com.br/v4_0/Common">
   <soapenv:Header>
      <sec:Info>
         <sec:Pos Domain="'.$this->domain.'" RequestorId="'.$this->userName.'" Language="pt-BR"/>
         <sec:Security>
            <sec:Token>'.$this->securityToken.'</sec:Token>
         </sec:Security>
      </sec:Info>
   </soapenv:Header>
   <soapenv:Body>
      <ser:BookingRulesRQ>
         <ser:ProductParams>
            <hot:ListHotelParam>
               <hot:HotelParam>
                  <com:TransactionToken>'.
                     $args['transactionToken'].'
                  </com:TransactionToken>
                  <com:ListProductToken>
                     '.$productTokens.'
                  </com:ListProductToken>
               </hot:HotelParam>
            </hot:ListHotelParam>
         </ser:ProductParams>
      </ser:BookingRulesRQ>
   </soapenv:Body>
</soapenv:Envelope>';
   }
   public function preparaXMLBookingCommit($args)
   {
      $rph = 1;
      $listPaxBooking = '';
      $listHotelBooking = '';
      
      foreach ($args['quartos'] as $key => $value) {
         $listPaxRPH = '';
         $paxRPH = '';
         foreach ($value as $key2 => $value2) {
            if($key2 == 'pax')
            {
               foreach ($value2 as $key3 => $value3) {
                  
                  $listPaxBooking .=   '<book:PaxBooking RPH="'.$rph.'">
                                          <com:Pax 
                                             Id="'.$rph.'" 
                                             FirstName="'.$value3['firstName'].'" 
                                             LastName="'.$value3['lastName'].'" 
                                             Type="'.$value3['type'].'"/>
                                       </book:PaxBooking>';
                  
                  $paxRPH = $paxRPH.' <com:PaxRPH RPH="'.$rph.'"/>';
                  $rph++;
               }
               $listHotelBooking = str_replace('#_PAXRPH', $paxRPH, $listHotelBooking); 
            }else if($key2 == 'productToken'){
               $listHotelBooking.=  '<book:HotelBooking>
                                       <hot:RoomParam>
                                          <com:TransactionToken>'.$this->transactionToken.'</com:TransactionToken>
                                          <com:ProductToken>'.$value2.'</com:ProductToken>
                                       </hot:RoomParam>
                                       <com:ListPaxRPH>
                                         #_PAXRPH
                                       </com:ListPaxRPH>
                                    </book:HotelBooking>';
            }
         }
      }

      return '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:sec="http://www.trendoperadora.com.br/v4_0/Security" xmlns:ser="http://www.trendoperadora.com.br/v4_0/Services" xmlns:hot="http://www.trendoperadora.com.br/v4_0/Hotel" xmlns:com="http://www.trendoperadora.com.br/v4_0/Common" xmlns:book="http://www.trendoperadora.com.br/v4_0/Booking">
   <soapenv:Header>
      <sec:Info>
         <sec:Pos Domain="'.$this->domain.'" Language = "pt-BR" Currency="'.$this->currencyCode.'" RequestorId="'.$this->userName.'" IssuingId="'.$this->issuerId.'"/>
         <sec:Security>
            <sec:Token>'.$this->securityToken.'</sec:Token>
         </sec:Security>
      </sec:Info>
   </soapenv:Header>
   <soapenv:Body>
      <ser:BookingCommitRQ>
         <ser:BookingRQ>
            <book:ListPaxBooking>
            '.$listPaxBooking.'
            </book:ListPaxBooking>
            <ser:ListHotelBookingDetail>
               <book:HotelBookingDetail>
                  <book:BookingDetailSimple Type="NOR"/>
                  <book:ListBookingDetailObservation/>
                  <book:ListHotelBooking>'
                     .$listHotelBooking.'
                  </book:ListHotelBooking>
               </book:HotelBookingDetail>               
            </ser:ListHotelBookingDetail><ser:BookingParam IgnoreDuplicity="true" PaymentId="'.$args['paymentId'].'" OfflineBooking="'.$args['offlineBooking'].'"/>
            <ser:Issuing Id="'.$this->issuerId.'"/>
         </ser:BookingRQ>
         <ser:CommitRQ>
            <com:TransactionToken>'.$this->transactionToken.'</com:TransactionToken>
            <ser:Commit Id="'.$this->issuerId.'" CustomerId="'.$this->agencyId.'" CurrencyTotalSales="'.$args['currencyTotalSales'].'"/>
            <ser:Contractors>
               <ser:ContractorCommit>
                  <ser:Payments>
                     <ser:Payment>
                        <ser:PaymentCommit Id="'.$args['paymentId'].'"/>
                        <ser:PaymentPlan Id="'.$args['paymentId'].'" TotalPrice="'.$args['currencyTotalSales'].'"/>
                     </ser:Payment>
                  </ser:Payments>
               </ser:ContractorCommit>
            </ser:Contractors>
         </ser:CommitRQ>
      </ser:BookingCommitRQ>
   </soapenv:Body>
</soapenv:Envelope>';
   }

   public function preparaXMLCancellation($args)
   {
      $bookingDetailIds = '';

      foreach ($args['bookingDetailIds'] as $key => $value) {
         $bookingDetailIds = $bookingDetailIds.'<ser:Detail BookingDetailId="'.$value['bookingDetailId'].'"/>';
      }

      return '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:sec="http://www.trendoperadora.com.br/v4_0/Security" xmlns:ser="http://www.trendoperadora.com.br/v4_0/Services" xmlns:book="http://www.trendoperadora.com.br/v4_0/Booking" xmlns:com="http://www.trendoperadora.com.br/v4_0/Common">
   <soapenv:Header>
      <sec:Info>
         <sec:Pos Domain="'.$this->domain.'" RequestorId="'.$this->userName.'"/>
         <sec:Security>
            <sec:Token>'.$this->securityToken.'</sec:Token>
         </sec:Security>
      </sec:Info>
   </soapenv:Header>
   <soapenv:Body>
      <ser:CancellationRQ>
         <ser:Cancellation>
            <ser:MasterBookingId>'.$args['masterBookingId'].'</ser:MasterBookingId>
            <ser:Reason>'.$args['reason'].'</ser:Reason>
            <ser:ListDetail>
'.$bookingDetailIds.'
            </ser:ListDetail>
         </ser:Cancellation>
      </ser:CancellationRQ>
   </soapenv:Body>
</soapenv:Envelope>';

   }

   public function preparaXMLProductSearchFilter()
   {

      return '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:sec="http://www.trendoperadora.com.br/v4_0/Security" xmlns:ser="http://www.trendoperadora.com.br/v4_0/Services">
   <soapenv:Header>
      <sec:Info>
         <sec:Pos Domain="'.$this->domain.'" Language="pt-BR" Currency="'.$this->currencyCode.'" RequestorId="'.$this->userName.'" IssuingId="'.$this->issuerId.'"/>
            <sec:Security>
               <sec:Token>'.$this->securityToken.'</sec:Token>
            </sec:Security>
      </sec:Info>
   </soapenv:Header>
   <soapenv:Body>
      <ser:DestinationListRequest/>
   </soapenv:Body>
</soapenv:Envelope>';
   }

   private function limpa_response($data)
   {
      $data = str_replace("<s:","<",$data);
      $data = str_replace("</s:","</",$data);
      $data = str_replace("<env:","<",$data);
      $data = str_replace("</env:","</",$data);
      $data = str_replace("<wsa:","<",$data);
      $data = str_replace("</wsa:","</",$data);
      $data = str_replace("<instra:","<",$data);
      $data = str_replace("</instra:","</",$data);
      $data = str_replace("<svc:","<",$data);
      $data = str_replace("</svc:","</",$data);
      $data = str_replace("<ns2:","<",$data);
      $data = str_replace("</ns2:","</",$data);
      $data = str_replace("<ns4:","<",$data);
      $data = str_replace("</ns4:","</",$data);
      $data = str_replace("<ns5:","<",$data);
      $data = str_replace("</ns5:","</",$data);
      $data = str_replace("<ns6:","<",$data);
      $data = str_replace("</ns6:","</",$data);
      $data = str_replace("<ns7:","<",$data);
      $data = str_replace("</ns7:","</",$data);
      $data = str_replace("<ns8:","<",$data);
      $data = str_replace("</ns8:","</",$data);
      $data = str_replace("<ns9:","<",$data);
      $data = str_replace("</ns9:","</",$data);
      $data = str_replace("<ns11:","<",$data);
      $data = str_replace("</ns11:","</",$data);
      $data = str_replace("<ns12:","<",$data);
      $data = str_replace("</ns12:","</",$data);
      $data = str_replace("<ns13:","<",$data);
      $data = str_replace("</ns13:","</",$data);
      $data = str_replace("<ns16:","<",$data);
      $data = str_replace("</ns16:","</",$data);
      $data = str_replace("<com:","<",$data);
      $data = str_replace("</com:","</",$data);
      $data = str_replace("<ser:","<",$data);
      $data = str_replace("</ser:","</",$data);
      $data = str_replace("<soapenv:","<",$data);
      $data = str_replace("</soapenv:","</",$data);

      return $data;
   }

}