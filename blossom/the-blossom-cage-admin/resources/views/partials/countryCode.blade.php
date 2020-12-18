 <select id="countryCode" name="countryCode" class="selectpicker" @if(old('countryCode') == "+213" ) selected @endif >
     @if(isset($employee['countryCode']) && $employee['countryCode'])
     <option  value="+{{$employee['countryCode']}}"   >{{$employee['countryName']}} (+{{$employee['countryCode']}})</option>
    @else
     <option data-countryCode="SA" value="+966" @if(old('countryCode') == "+966" ) selected @endif >Saudi Arabia (+966)</option>
     @endif

    <optgroup label="Other countries" @if(old('countryCode') == "+213" ) selected @endif >
        <option data-countryCode="DZ" value="+213" @if(old('countryCode') == "+213" ) selected @endif >Algeria (+213)</option>
        <option data-countryCode="AD" value="+376" @if(old('countryCode') == "+376" ) selected @endif >Andorra (+376)</option>
        <option data-countryCode="AO" value="+244" @if(old('countryCode') == "+244" ) selected @endif >Angola (+244)</option>
        <option data-countryCode="AI" value="+1264" @if(old('countryCode') == "+1264" ) selected @endif >Anguilla (+1264)</option>
        <option data-countryCode="AG" value="+1268" @if(old('countryCode') == "+1268" ) selected @endif >Antigua &amp; Barbuda (+1268)</option>
        <option data-countryCode="AR" value="+54" @if(old('countryCode') == "+54" ) selected @endif >Argentina (+54)</option>
        <option data-countryCode="AM" value="+374" @if(old('countryCode') == "+374" ) selected @endif >Armenia (+374)</option>
        <option data-countryCode="AW" value="+297" @if(old('countryCode') == "+297" ) selected @endif >Aruba (+297)</option>
        <option data-countryCode="AU" value="+61" @if(old('countryCode') == "+61" ) selected @endif >Australia (+61)</option>
        <option data-countryCode="AT" value="+43" @if(old('countryCode') == "+43" ) selected @endif >Austria (+43)</option>
        <option data-countryCode="AZ" value="+994" @if(old('countryCode') == "+994" ) selected @endif >Azerbaijan (+994)</option>
        <option data-countryCode="BS" value="+1242" @if(old('countryCode') == "+1242" ) selected @endif >Bahamas (+1242)</option>
        <option data-countryCode="BH" value="+973" @if(old('countryCode') == "+973" ) selected @endif >Bahrain (+973)</option>
        <option data-countryCode="BD" value="+880" @if(old('countryCode') == "+880" ) selected @endif >Bangladesh (+880)</option>
        <option data-countryCode="BB" value="+1246" @if(old('countryCode') == "+1246" ) selected @endif >Barbados (+1246)</option>
        <option data-countryCode="BY" value="+375" @if(old('countryCode') == "+375" ) selected @endif >Belarus (+375)</option>
        <option data-countryCode="BE" value="+32" @if(old('countryCode') == "+32" ) selected @endif >Belgium (+32)</option>
        <option data-countryCode="BZ" value="+501" @if(old('countryCode') == "+501" ) selected @endif >Belize (+501)</option>
        <option data-countryCode="BJ" value="+229" @if(old('countryCode') == "+229" ) selected @endif >Benin (+229)</option>
        <option data-countryCode="BM" value="+1441" @if(old('countryCode') == "+1441" ) selected @endif >Bermuda (+1441)</option>
        <option data-countryCode="BT" value="+975" @if(old('countryCode') == "+975" ) selected @endif >Bhutan (+975)</option>
        <option data-countryCode="BO" value="+591" @if(old('countryCode') == "+591" ) selected @endif >Bolivia (+591)</option>
        <option data-countryCode="BA" value="+387" @if(old('countryCode') == "+387" ) selected @endif >Bosnia Herzegovina (+387)</option>
        <option data-countryCode="BW" value="+267" @if(old('countryCode') == "+267" ) selected @endif >Botswana (+267)</option>
        <option data-countryCode="BR" value="+55" @if(old('countryCode') == "+55" ) selected @endif >Brazil (+55)</option>
        <option data-countryCode="BN" value="+673" @if(old('countryCode') == "+673" ) selected @endif >Brunei (+673)</option>
        <option data-countryCode="BG" value="+359" @if(old('countryCode') == "+359" ) selected @endif >Bulgaria (+359)</option>
        <option data-countryCode="BF" value="+226" @if(old('countryCode') == "+226" ) selected @endif >Burkina Faso (+226)</option>
        <option data-countryCode="BI" value="+257" @if(old('countryCode') == "+257" ) selected @endif >Burundi (+257)</option>
        <option data-countryCode="KH" value="+855" @if(old('countryCode') == "+855" ) selected @endif >Cambodia (+855)</option>
        <option data-countryCode="CM" value="+237" @if(old('countryCode') == "+237" ) selected @endif >Cameroon (+237)</option>
        <option data-countryCode="CA" value="+1" @if(old('countryCode') == "+1" ) selected @endif >Canada (+1)</option>
        <option data-countryCode="CV" value="+238" @if(old('countryCode') == "+238" ) selected @endif >Cape Verde Islands (+238)</option>
        <option data-countryCode="KY" value="+1345" @if(old('countryCode') == "+1345" ) selected @endif >Cayman Islands (+1345)</option>
        <option data-countryCode="CF" value="+236" @if(old('countryCode') == "+236" ) selected @endif >Central African Republic (+236)</option>
        <option data-countryCode="CL" value="+56" @if(old('countryCode') == "+56" ) selected @endif >Chile (+56)</option>
        <option data-countryCode="CN" value="+86" @if(old('countryCode') == "+86" ) selected @endif >China (+86)</option>
        <option data-countryCode="CO" value="+57" @if(old('countryCode') == "+57" ) selected @endif >Colombia (+57)</option>
        <option data-countryCode="KM" value="+269" @if(old('countryCode') == "+269" ) selected @endif >Comoros (+269)</option>
        <option data-countryCode="CG" value="+242" @if(old('countryCode') == "+242" ) selected @endif >Congo (+242)</option>
        <option data-countryCode="CK" value="+682" @if(old('countryCode') == "+682" ) selected @endif >Cook Islands (+682)</option>
        <option data-countryCode="CR" value="+506" @if(old('countryCode') == "+506" ) selected @endif >Costa Rica (+506)</option>
        <option data-countryCode="HR" value="+385" @if(old('countryCode') == "+385" ) selected @endif >Croatia (+385)</option>
        <option data-countryCode="CU" value="+53" @if(old('countryCode') == "+53" ) selected @endif >Cuba (+53)</option>
        <option data-countryCode="CY" value="+90392" @if(old('countryCode') == "+90392" ) selected @endif >Cyprus North (+90392)</option>
        <option data-countryCode="CY" value="+357" @if(old('countryCode') == "+357" ) selected @endif >Cyprus South (+357)</option>
        <option data-countryCode="CZ" value="+42" @if(old('countryCode') == "+42" ) selected @endif >Czech Republic (+42)</option>
        <option data-countryCode="DK" value="+45" @if(old('countryCode') == "+45" ) selected @endif >Denmark (+45)</option>
        <option data-countryCode="DJ" value="+253" @if(old('countryCode') == "+253" ) selected @endif >Djibouti (+253)</option>
        <option data-countryCode="DM" value="+1809" @if(old('countryCode') == "+1809" ) selected @endif >Dominica (+1809)</option>
        <option data-countryCode="DO" value="+1809" @if(old('countryCode') == "+1809" ) selected @endif >Dominican Republic (+1809)</option>
        <option data-countryCode="EC" value="+593" @if(old('countryCode') == "+593" ) selected @endif >Ecuador (+593)</option>
        <option data-countryCode="EG" value="+20" @if(old('countryCode') == "+20" ) selected @endif >Egypt (+20)</option>
        <option data-countryCode="SV" value="+503" @if(old('countryCode') == "+503" ) selected @endif >El Salvador (+503)</option>
        <option data-countryCode="GQ" value="+240" @if(old('countryCode') == "+240" ) selected @endif >Equatorial Guinea (+240)</option>
        <option data-countryCode="ER" value="+291" @if(old('countryCode') == "+291" ) selected @endif >Eritrea (+291)</option>
        <option data-countryCode="EE" value="+372" @if(old('countryCode') == "+372" ) selected @endif >Estonia (+372)</option>
        <option data-countryCode="ET" value="+251" @if(old('countryCode') == "+251" ) selected @endif >Ethiopia (+251)</option>
        <option data-countryCode="FK" value="+500" @if(old('countryCode') == "+500" ) selected @endif >Falkland Islands (+500)</option>
        <option data-countryCode="FO" value="+298" @if(old('countryCode') == "+298" ) selected @endif >Faroe Islands (+298)</option>
        <option data-countryCode="FJ" value="+679" @if(old('countryCode') == "+679" ) selected @endif >Fiji (+679)</option>
        <option data-countryCode="FI" value="+358" @if(old('countryCode') == "+358" ) selected @endif >Finland (+358)</option>
        <option data-countryCode="FR" value="+33" @if(old('countryCode') == "+33" ) selected @endif >France (+33)</option>
        <option data-countryCode="GF" value="+594" @if(old('countryCode') == "+594" ) selected @endif >French Guiana (+594)</option>
        <option data-countryCode="PF" value="+689" @if(old('countryCode') == "+689" ) selected @endif >French Polynesia (+689)</option>
        <option data-countryCode="GA" value="+241" @if(old('countryCode') == "+241" ) selected @endif >Gabon (+241)</option>
        <option data-countryCode="GM" value="+220" @if(old('countryCode') == "+220" ) selected @endif >Gambia (+220)</option>
        <option data-countryCode="GE" value="+7880" @if(old('countryCode') == "+7880" ) selected @endif >Georgia (+7880)</option>
        <option data-countryCode="DE" value="+49" @if(old('countryCode') == "+49" ) selected @endif >Germany (+49)</option>
        <option data-countryCode="GH" value="+233" @if(old('countryCode') == "+233" ) selected @endif >Ghana (+233)</option>
        <option data-countryCode="GI" value="+350" @if(old('countryCode') == "+350" ) selected @endif >Gibraltar (+350)</option>
        <option data-countryCode="GR" value="+30" @if(old('countryCode') == "+30" ) selected @endif >Greece (+30)</option>
        <option data-countryCode="GL" value="+299" @if(old('countryCode') == "+299" ) selected @endif >Greenland (+299)</option>
        <option data-countryCode="GD" value="+1473" @if(old('countryCode') == "+1473" ) selected @endif >Grenada (+1473)</option>
        <option data-countryCode="GP" value="+590" @if(old('countryCode') == "+590" ) selected @endif >Guadeloupe (+590)</option>
        <option data-countryCode="GU" value="+671" @if(old('countryCode') == "+671" ) selected @endif >Guam (+671)</option>
        <option data-countryCode="GT" value="+502" @if(old('countryCode') == "+502" ) selected @endif >Guatemala (+502)</option>
        <option data-countryCode="GN" value="+224" @if(old('countryCode') == "+224" ) selected @endif >Guinea (+224)</option>
        <option data-countryCode="GW" value="+245" @if(old('countryCode') == "+245" ) selected @endif >Guinea - Bissau (+245)</option>
        <option data-countryCode="GY" value="+592" @if(old('countryCode') == "+592" ) selected @endif >Guyana (+592)</option>
        <option data-countryCode="HT" value="+509" @if(old('countryCode') == "+509" ) selected @endif >Haiti (+509)</option>
        <option data-countryCode="HN" value="+504" @if(old('countryCode') == "+504" ) selected @endif >Honduras (+504)</option>
        <option data-countryCode="HK" value="+852" @if(old('countryCode') == "+852" ) selected @endif >Hong Kong (+852)</option>
        <option data-countryCode="HU" value="+36" @if(old('countryCode') == "+36" ) selected @endif >Hungary (+36)</option>
        <option data-countryCode="IS" value="+354" @if(old('countryCode') == "+354" ) selected @endif >Iceland (+354)</option>
        <option data-countryCode="IN" value="+91" @if(old('countryCode') == "+91" ) selected @endif >India (+91)</option>
        <option data-countryCode="ID" value="+62" @if(old('countryCode') == "+63" ) selected @endif >Indonesia (+62)</option>
        <option data-countryCode="IR" value="+98" @if(old('countryCode') == "+98" ) selected @endif >Iran (+98)</option>
        <option data-countryCode="IQ" value="+964" @if(old('countryCode') == "+964" ) selected @endif >Iraq (+964)</option>
        <option data-countryCode="IE" value="+353" @if(old('countryCode') == "+353" ) selected @endif >Ireland (+353)</option>
        <option data-countryCode="IL" value="+972" @if(old('countryCode') == "+972" ) selected @endif >Israel (+972)</option>
        <option data-countryCode="IT" value="+39" @if(old('countryCode') == "+39" ) selected @endif >Italy (+39)</option>
        <option data-countryCode="JM" value="+1876" @if(old('countryCode') == "+1876" ) selected @endif >Jamaica (+1876)</option>
        <option data-countryCode="JP" value="+81" @if(old('countryCode') == "+81" ) selected @endif >Japan (+81)</option>
        <option data-countryCode="JO" value="+962" @if(old('countryCode') == "+962" ) selected @endif >Jordan (+962)</option>
        <option data-countryCode="KZ" value="+7" @if(old('countryCode') == "+7" ) selected @endif >Kazakhstan (+7)</option>
        <option data-countryCode="KI" value="+686" @if(old('countryCode') == "+686" ) selected @endif >Kiribati (+686)</option>
        <option data-countryCode="KP" value="+850" @if(old('countryCode') == "+850" ) selected @endif >Korea North (+850)</option>
        <option data-countryCode="KR" value="+82" @if(old('countryCode') == "+82" ) selected @endif >Korea South (+82)</option>
        <option data-countryCode="KW" value="+965" @if(old('countryCode') == "+965" ) selected @endif >Kuwait (+965)</option>
        <option data-countryCode="KG" value="+996" @if(old('countryCode') == "+996" ) selected @endif >Kyrgyzstan (+996)</option>
        <option data-countryCode="LA" value="+856" @if(old('countryCode') == "+856" ) selected @endif >Laos (+856)</option>
        <option data-countryCode="LV" value="+371" @if(old('countryCode') == "+371" ) selected @endif >Latvia (+371)</option>
        <option data-countryCode="LB" value="+961" @if(old('countryCode') == "+961" ) selected @endif >Lebanon (+961)</option>
        <option data-countryCode="LS" value="+266" @if(old('countryCode') == "+266" ) selected @endif >Lesotho (+266)</option>
        <option data-countryCode="LR" value="+231" @if(old('countryCode') == "+231" ) selected @endif >Liberia (+231)</option>
        <option data-countryCode="LY" value="+218" @if(old('countryCode') == "+218" ) selected @endif >Libya (+218)</option>
        <option data-countryCode="LI" value="+417" @if(old('countryCode') == "+417" ) selected @endif >Liechtenstein (+417)</option>
        <option data-countryCode="LT" value="+370" @if(old('countryCode') == "+370" ) selected @endif >Lithuania (+370)</option>
        <option data-countryCode="LU" value="+352" @if(old('countryCode') == "+352" ) selected @endif >Luxembourg (+352)</option>
        <option data-countryCode="MO" value="+853" @if(old('countryCode') == "+853" ) selected @endif >Macao (+853)</option>
        <option data-countryCode="MK" value="+389" @if(old('countryCode') == "+389" ) selected @endif >Macedonia (+389)</option>
        <option data-countryCode="MG" value="+261" @if(old('countryCode') == "+261" ) selected @endif >Madagascar (+261)</option>
        <option data-countryCode="MW" value="+265" @if(old('countryCode') == "+265" ) selected @endif >Malawi (+265)</option>
        <option data-countryCode="MY" value="+60" @if(old('countryCode') == "+60" ) selected @endif >Malaysia (+60)</option>
        <option data-countryCode="MV" value="+960" @if(old('countryCode') == "+960" ) selected @endif >Maldives (+960)</option>
        <option data-countryCode="ML" value="+223" @if(old('countryCode') == "+223" ) selected @endif >Mali (+223)</option>
        <option data-countryCode="MT" value="+356" @if(old('countryCode') == "+356" ) selected @endif >Malta (+356)</option>
        <option data-countryCode="MH" value="+692" @if(old('countryCode') == "+692" ) selected @endif >Marshall Islands (+692)</option>
        <option data-countryCode="MQ" value="+596" @if(old('countryCode') == "+596" ) selected @endif >Martinique (+596)</option>
        <option data-countryCode="MR" value="+222" @if(old('countryCode') == "+222" ) selected @endif >Mauritania (+222)</option>
        <option data-countryCode="YT" value="+269" @if(old('countryCode') == "+269" ) selected @endif >Mayotte (+269)</option>
        <option data-countryCode="MX" value="+52" @if(old('countryCode') == "+52" ) selected @endif >Mexico (+52)</option>
        <option data-countryCode="FM" value="+691" @if(old('countryCode') == "+691" ) selected @endif >Micronesia (+691)</option>
        <option data-countryCode="MD" value="+373" @if(old('countryCode') == "+373" ) selected @endif >Moldova (+373)</option>
        <option data-countryCode="MC" value="+377" @if(old('countryCode') == "+377" ) selected @endif >Monaco (+377)</option>
        <option data-countryCode="MN" value="+976" @if(old('countryCode') == "+976" ) selected @endif >Mongolia (+976)</option>
        <option data-countryCode="MS" value="+1664" @if(old('countryCode') == "+2664" ) selected @endif >Montserrat (+1664)</option>
        <option data-countryCode="MA" value="+212" @if(old('countryCode') == "+212" ) selected @endif >Morocco (+212)</option>
        <option data-countryCode="MZ" value="+258" @if(old('countryCode') == "+258" ) selected @endif >Mozambique (+258)</option>
        <option data-countryCode="MN" value="+95" @if(old('countryCode') == "+95" ) selected @endif >Myanmar (+95)</option>
        <option data-countryCode="NA" value="+264" @if(old('countryCode') == "+264" ) selected @endif >Namibia (+264)</option>
        <option data-countryCode="NR" value="+674" @if(old('countryCode') == "+674" ) selected @endif >Nauru (+674)</option>
        <option data-countryCode="NP" value="+977" @if(old('countryCode') == "+977" ) selected @endif >Nepal (+977)</option>
        <option data-countryCode="NL" value="+31" @if(old('countryCode') == "+31" ) selected @endif >Netherlands (+31)</option>
        <option data-countryCode="NC" value="+687" @if(old('countryCode') == "+687" ) selected @endif >New Caledonia (+687)</option>
        <option data-countryCode="NZ" value="+64" @if(old('countryCode') == "+64" ) selected @endif >New Zealand (+64)</option>
        <option data-countryCode="NI" value="+505" @if(old('countryCode') == "+505" ) selected @endif >Nicaragua (+505)</option>
        <option data-countryCode="NE" value="+227" @if(old('countryCode') == "+227" ) selected @endif >Niger (+227)</option>
        <option data-countryCode="NG" value="+234" @if(old('countryCode') == "+234" ) selected @endif >Nigeria (+234)</option>
        <option data-countryCode="NU" value="+683" @if(old('countryCode') == "+683" ) selected @endif >Niue (+683)</option>
        <option data-countryCode="NF" value="+672" @if(old('countryCode') == "+672" ) selected @endif >Norfolk Islands (+672)</option>
        <option data-countryCode="NP" value="+670" @if(old('countryCode') == "+670" ) selected @endif >Northern Marianas (+670)</option>
        <option data-countryCode="NO" value="+47" @if(old('countryCode') == "+47" ) selected @endif >Norway (+47)</option>
        <option data-countryCode="OM" value="+968" @if(old('countryCode') == "+968" ) selected @endif >Oman (+968)</option>
        <option data-countryCode="PW" value="+680" @if(old('countryCode') == "+680" ) selected @endif >Palau (+680)</option>
        <option data-countryCode="PK" value="+92" @if(old('countryCode') == "+92" ) selected @endif  >Pakistan (+92)</option>
        <option data-countryCode="PA" value="+507" @if(old('countryCode') == "+507" ) selected @endif >Panama (+507)</option>
        <option data-countryCode="PG" value="+675" @if(old('countryCode') == "+675" ) selected @endif >Papua New Guinea (+675)</option>
        <option data-countryCode="PY" value="+595" @if(old('countryCode') == "+595" ) selected @endif >Paraguay (+595)</option>
        <option data-countryCode="PE" value="+51" @if(old('countryCode') == "+51" ) selected @endif >Peru (+51)</option>
        <option data-countryCode="PH" value="+63" @if(old('countryCode') == "+63" ) selected @endif >Philippines (+63)</option>
        <option data-countryCode="PL" value="+48" @if(old('countryCode') == "+48" ) selected @endif >Poland (+48)</option>
        <option data-countryCode="PT" value="+351" @if(old('countryCode') == "+351" ) selected @endif >Portugal (+351)</option>
        <option data-countryCode="PR" value="+1787" @if(old('countryCode') == "+1787" ) selected @endif >Puerto Rico (+1787)</option>
        <option data-countryCode="QA" value="+974" @if(old('countryCode') == "+947" ) selected @endif >Qatar (+974)</option>
        <option data-countryCode="RE" value="+262" @if(old('countryCode') == "+262" ) selected @endif >Reunion (+262)</option>
        <option data-countryCode="RO" value="+40" @if(old('countryCode') == "+40" ) selected @endif >Romania (+40)</option>
        <option data-countryCode="RU" value="+7" @if(old('countryCode') == "+7" ) selected @endif >Russia (+7)</option>
        <option data-countryCode="RW" value="+250" @if(old('countryCode') == "+250" ) selected @endif >Rwanda (+250)</option>
        <option data-countryCode="SM" value="+378" @if(old('countryCode') == "+378" ) selected @endif >San Marino (+378)</option>
        <option data-countryCode="ST" value="+239" @if(old('countryCode') == "+239" ) selected @endif >Sao Tome &amp; Principe (+239)</option>
{{--        <option data-countryCode="SA" value="+966" @if(old('countryCode') == "+966" ) selected @endif >Saudi Arabia (+966)</option>--}}
        <option data-countryCode="SN" value="+221" @if(old('countryCode') == "+221" ) selected @endif >Senegal (+221)</option>
        <option data-countryCode="CS" value="+381" @if(old('countryCode') == "+381" ) selected @endif >Serbia (+381)</option>
        <option data-countryCode="SC" value="+248" @if(old('countryCode') == "+248" ) selected @endif >Seychelles (+248)</option>
        <option data-countryCode="SL" value="+232" @if(old('countryCode') == "+232" ) selected @endif >Sierra Leone (+232)</option>
        <option data-countryCode="SG" value="+65" @if(old('countryCode') == "+65" ) selected @endif >Singapore (+65)</option>
        <option data-countryCode="SK" value="+421" @if(old('countryCode') == "+421" ) selected @endif >Slovak Republic (+421)</option>
        <option data-countryCode="SI" value="+386" @if(old('countryCode') == "+386" ) selected @endif >Slovenia (+386)</option>
        <option data-countryCode="SB" value="+677" @if(old('countryCode') == "+667" ) selected @endif >Solomon Islands (+677)</option>
        <option data-countryCode="SO" value="+252" @if(old('countryCode') == "+252" ) selected @endif >Somalia (+252)</option>
        <option data-countryCode="ZA" value="+27" @if(old('countryCode') == "+27" ) selected @endif >South Africa (+27)</option>
        <option data-countryCode="ES" value="+34" @if(old('countryCode') == "+34" ) selected @endif >Spain (+34)</option>
        <option data-countryCode="LK" value="+94" @if(old('countryCode') == "+94" ) selected @endif >Sri Lanka (+94)</option>
        <option data-countryCode="SH" value="+290" @if(old('countryCode') == "+290" ) selected @endif >St. Helena (+290)</option>
        <option data-countryCode="KN" value="+1869" @if(old('countryCode') == "+1869" ) selected @endif >St. Kitts (+1869)</option>
        <option data-countryCode="SC" value="+1758" @if(old('countryCode') == "+1758" ) selected @endif >St. Lucia (+1758)</option>
        <option data-countryCode="SD" value="+249" @if(old('countryCode') == "+249" ) selected @endif >Sudan (+249)</option>
        <option data-countryCode="SR" value="+597" @if(old('countryCode') == "+597" ) selected @endif >Suriname (+597)</option>
        <option data-countryCode="SZ" value="+268" @if(old('countryCode') == "+268" ) selected @endif >Swaziland (+268)</option>
        <option data-countryCode="SE" value="+46" @if(old('countryCode') == "+46" ) selected @endif >Sweden (+46)</option>
        <option data-countryCode="CH" value="+41" @if(old('countryCode') == "+41" ) selected @endif >Switzerland (+41)</option>
        <option data-countryCode="SI" value="+963" @if(old('countryCode') == "+963" ) selected @endif >Syria (+963)</option>
        <option data-countryCode="TW" value="+886" @if(old('countryCode') == "+886" ) selected @endif >Taiwan (+886)</option>
       <option data-countryCode="TZ" value="+255" @if(old('countryCode') == "+255" ) selected @endif >Tanzania (+255)</option>
        <option data-countryCode="TJ" value="+7" @if(old('countryCode') == "+7" ) selected @endif >Tajikstan (+7)</option>
        <option data-countryCode="TH" value="+66" @if(old('countryCode') == "+66" ) selected @endif >Thailand (+66)</option>
        <option data-countryCode="TG" value="+228" @if(old('countryCode') == "+228" ) selected @endif >Togo (+228)</option>
        <option data-countryCode="TO" value="+676" @if(old('countryCode') == "+213" ) selected @endif >Tonga (+676)</option>
        <option data-countryCode="TT" value="+1868" @if(old('countryCode') == "+1868" ) selected @endif >Trinidad &amp; Tobago (+1868)</option>
        <option data-countryCode="TN" value="+216" @if(old('countryCode') == "+216" ) selected @endif >Tunisia (+216)</option>
        <option data-countryCode="TR" value="+90" @if(old('countryCode') == "+90" ) selected @endif >Turkey (+90)</option>
        <option data-countryCode="TM" value="+7" @if(old('countryCode') == "+7" ) selected @endif >Turkmenistan (+7)</option>
        <option data-countryCode="TM" value="+993" @if(old('countryCode') == "+993" ) selected @endif >Turkmenistan (+993)</option>
        <option data-countryCode="TC" value="+1649" @if(old('countryCode') == "+1649" ) selected @endif >Turks &amp; Caicos Islands (+1649)</option>
        <option data-countryCode="TV" value="+688" @if(old('countryCode') == "+688" ) selected @endif >Tuvalu (+688)</option>
        <option data-countryCode="UG" value="+256" @if(old('countryCode') == "+256" ) selected @endif >Uganda (+256)</option>
        <option data-countryCode="GB" value="+44" @if(old('countryCode') == "+44" ) selected @endif >UK (+44)</option>
        <option data-countryCode="UA" value="+380" @if(old('countryCode') == "+380" ) selected @endif >Ukraine (+380)</option>
        <option data-countryCode="AE" value="+971" @if(old('countryCode') == "+971" ) selected @endif >United Arab Emirates (+971)</option>
        <option data-countryCode="UY" value="+598" @if(old('countryCode') == "+598" ) selected @endif >Uruguay (+598)</option>
        <option data-countryCode="US" value="+1" @if(old('countryCode') == "+1" ) selected @endif >USA (+1)</option>
        <option data-countryCode="UZ" value="+7" @if(old('countryCode') == "+7" ) selected @endif >Uzbekistan (+7)</option>
        <option data-countryCode="VU" value="+678" @if(old('countryCode') == "+678" ) selected @endif >Vanuatu (+678)</option>
        <option data-countryCode="VA" value="+379" @if(old('countryCode') == "+379" ) selected @endif >Vatican City (+379)</option>
        <option data-countryCode="VE" value="+58" @if(old('countryCode') == "+58" ) selected @endif >Venezuela (+58)</option>
        <option data-countryCode="VN" value="+84" @if(old('countryCode') == "+84" ) selected @endif >Vietnam (+84)</option>
        <option data-countryCode="VG" value="+84" @if(old('countryCode') == "+84" ) selected @endif >Virgin Islands - British (+1284)</option>
        <option data-countryCode="VI" value="+84" @if(old('countryCode') == "+84" ) selected @endif >Virgin Islands - US (+1340)</option>
        <option data-countryCode="WF" value="+681" @if(old('countryCode') == "+681" ) selected @endif >Wallis &amp; Futuna (+681)</option>
        <option data-countryCode="YE" value="+969" @if(old('countryCode') == "+969" ) selected @endif >Yemen (North)(+969)</option>
        <option data-countryCode="YE" value="+967" @if(old('countryCode') == "+967" ) selected @endif >Yemen (South)(+967)</option>
         <option data-countryCode="ZM" value="+260" @if(old('countryCode') == "+260" ) selected @endif >Zambia (+260)</option>
        <option data-countryCode="ZW" value="+263" @if(old('countryCode') == "+263" ) selected @endif >Zimbabwe (+263)</option>
    </optgroup>
</select>