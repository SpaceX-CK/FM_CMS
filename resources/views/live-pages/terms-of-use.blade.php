
@extends('live-pages.layouts.live')

@section('content')

  <section id="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <ul class="breadcrumbs">
            <li><a href="{{ route('index') }}">Home</a></li> <span><i class="fa fa-caret-right"></i></span>
            <li>Privacy Policy</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section id="policies">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <p><span class="font-weight-bold text-green">TERMS OF USE</span><br />
            Terms and conditions related to your access and the use of this website <br />
            Please take a moment to read these terms and conditions carefully. <br />
            THE FOLLOWING TERMS AND CONDITIONS APPLY TO YOUR ACCESS AND THE USE OF THIS WEBSITE AND THE SERVICES
            PROVIDED HEREIN BY TOHTONKU SDN BHD AND ITS SUBSIDIARIES. BY ACCESSING ANY PAGE OF THIS WEBSITE AND/OR USING
            THE SERVICES, YOU AGREE TO BE BOUND BY THESE TERMS AND CONDITIONS WITHOUT LIMITATION OR QUALIFICATION.
            IF YOU DO NOT ACCEPT THESE TERMS AND CONDITIONS, PLEASE IMMEDIATELY DISCONTINUE YOUR ACCESS TO THIS WEBSITE
            AND/OR USE OF THE SERVICES.
          </p>
          <p><span class="font-weight-bold text-green">GENERAL</span><br />
            he term “TOHTONKU” as used in these terms and conditions refers to TOHTONKU SDN BHD. The term “TOHTONKU”
            refers to TOHTONKU and its subsidiaries, either individually and/or collectively as the context requires.
            <br />
            All products and services of TOHTONKU and its partners herein provided are subject to the terms and
            conditions of the applicable agreements governing their use. These terms and conditions are meant to
            regulate your access to this website and they are to be read together with the applicable terms and
            conditions governing any transaction(s), product(s) and/or service(s) provided in this website. In the event
            of conflict between these terms and conditions and the terms and conditions governing the relevant
            transaction(s), product(s) and/or service(s) provided herein, the latter will prevail. <br />
            The information, material, functions and content provided in the pages of the website may be changed from
            time to time with or without notice at TOHTONKU’s absolute discretion. Your continued access or use of the
            website and/or the services provided herein subsequent to any such change will be deemed as your acceptance
            to those changes.
          </p>
          <p><span class="font-weight-bold text-green">DISCLAIMER</span> <br />
            The materials and information in this website, including but not limited to services, products, information,
            data, text, graphics, audio, video, links or other items, are provided by TOHTONKU on an “as is” and “as
            available” basis. References to material and information contained in the website include such material and
            information provided by third parties. <br />
            TOHTONKU does not make any express or implied warranties, representations or endorsements including but not
            limited to any warranties of title, non-infringement, merchantability, usefulness, operation, completeness,
            currentness, accuracy, satisfactory quality, reliability, fitness for a particular purpose in respect of the
            website, the material, information and/or functions therein and expressly disclaims liability for errors and
            omissions in such materials, information and/or functions. Without derogation of the above and/or the terms
            and conditions of the applicable agreements governing all the products and services of TOHTONKU, reasonable
            measures will be taken by TOHTONKU to ensure the accuracy and validity of all information relating to
            transactions and products of TOHTONKU which originate exclusively from TOHTONKU. <br />
            Further TOHTONKU does not warrant or represent that access to the whole or part(s) of this website, the
            materials, information and/or functions contained therein will be provided uninterrupted or free from errors
            or that any identified defect will be corrected, or that there will be no delays, failures, errors or loss
            of transmitted information, that no viruses or other contaminating or destructive properties will be
            transmitted or that no damage will occur to your computer system. <br />
            The materials, information and functions provided in this website shall not under any circumstances be
            considered or construed as an offer or solicitation to sell, buy, give, take, issue, allot or transfer, or
            as the giving of any advice in respect of shares, stocks, bonds, notes, interests, unit trusts, mutual funds
            or other securities, investments, loans, advances, credits or deposits in any jurisdiction. <br />
            You shall be responsible to evaluate the quality, adequacy, completeness, currentness and usefulness of all
            services, content, advice, opinions and other information obtained or accessible through the website;
            further you should seek professional advice at all times and obtain independent verification of the
            materials and information provided herein prior to making any investment, business or commercial decision
            based on any such materials or information.
          </p>
          <p><span class="font-weight-bold text-green">LINKS</span> <br />
            Links from or to websites outside this website are meant for convenience only. Such linked websites are
            owned and operated by third parties and as such are not under the control of TOHTONKU. Therefore TOHTONKU
            shall not be responsible and makes no warranties in respect of the contents of those websites, the third
            parties named therein or their products and services. Furthermore, the links provided in this website shall
            not be considered an endorsement or verification or approval of such linked websites or the contents
            therein.
            Linking to any other site is at your sole risk and TOHTONKU will not be responsible or liable for any
            damages in connection with linking. It is advisable for you to read the privacy policy statements (if any)
            of any websites which are linked to this website.
          </p>
          <p><span class="font-weight-bold text-green">COPYRIGHT</span> <br />
            Unless otherwise indicated, the copyright in this website and its contents, including but not limited to the
            text, images, graphics, sound files, animation files, video files, and their arrangement, are the property
            of TOHTONKU, and are protected by applicable Malaysian and international copyright laws. No part or parts of
            this website may be modified, copied, distributed, retransmitted, broadcast, displayed, performed,
            reproduced, published, licensed, transferred, sold or commercially dealt with in any manner without the
            express prior written consent of TOHTONKU. <br />
            You also may not, without TOHTONKU’s expressed prior written consent, insert a link to this website on any
            other website, frame or “mirror” any material contained on this website on any other server. <br />
            Any such unauthorised reproduction, retransmission or other copying or modification of any of the contents
            of TOHTONKU’s website may be in breach of statutory or common law rights which could be the subject of legal
            action.
            TOHTONKU disclaims all liability which may arise from any unauthorised reproduction or use of the contents
            of this TOHTONKU’s website.
          </p>
          <p><span class="font-weight-bold text-green">TRADEMARKS</span> <br />
            All trademarks, service marks, and logos displayed in this website are the property of TOHTONKU and/or their
            respective third party proprietors as identified in the website.
            Unless the prior written consent of TOHTONKU or the relevant third party proprietor of any of the
            trademarks, service marks or logos appearing on the website has been obtained, no license or right is
            granted to any party accessing this website to use, download, reproduce, copy or modify such trademarks,
            services marks or logos. Similarly, unless the prior written consent of TOHTONKU or the relevant proprietor
            has been obtained, no such trademark, service mark or logo may be used as a link or to mark any link to
            TOHTONKU ‘s website or any other site.
          </p>
          <p><span class="font-weight-bold text-green">EXCLUSION OF LIABILITY</span> <br />
            TOHTONKU and/or its partners herein shall in no event be liable for any loss or damages howsoever arising
            whether in contract, tort, negligence, strict liability or any other basis, including without limitation,
            direct or indirect, special, incidental, consequential or punitive damages, or loss profits or savings
            arising in connection with your access or use or the inability to access or use this website (or any third
            party link to or from TOHTONKU ‘s website), reliance on the information contained in the website, any
            technical, hardware or software failure of any kind, the interruption, error, omission, delay in operation,
            computer viruses, or otherwise. This exclusion clause shall take effect to the fullest extent permitted by
            law.
          </p>
          <p><span class="font-weight-bold text-green">INDEMNITY</span> <br />
            You hereby irrevocably agree to indemnify and keep indemnified TOHTONKU from all liabilities, claims, losses
            and expenses, including any legal fees that may be incurred by TOHTONKU in connection with or arising from
            (1) your use or misuse of this website and the services provided herein, or (2) your breach of these terms
            and conditions howsoever occasioned, or (3) any intellectual property right or proprietary right
            infringement claim made by a third party against TOHTONKU in connection with your use of this website.
          </p>
          <p><span class="font-weight-bold text-green">TERMINATION</span> <br />
            TOHTONKU reserves the right to terminate and/or suspend your access to this website and/or your use of this
            website at any time, for any reason. In particular, and without limitation, TOHTONKU may terminate and/or
            suspend your access should you violate any of these terms and conditions, or of any third party.
          </p>
          <p><span class="font-weight-bold text-green">MISCELLANEOUS</span> <br />
            The failure of TOHTONKU to exercise or enforce any right or provision of these terms and conditions shall
            not constitute a waiver of such right or provision. If any part of these terms and conditions is determined
            to be invalid or unenforceable pursuant to applicable law, then the invalid and unenforceable provision will
            be deemed superseded by a valid, enforceable provision that most closely matches the intent of the original
            provision and the remainder of the other provisions of the terms and conditions shall continue in full force
            and effect.
            Any rights not expressly granted herein are reserved.
          </p>
          <p><span class="font-weight-bold text-green">LAW AND JURISDICTION</span> <br />
            These terms and conditions are governed by and are to be construed in accordance with the laws of Malaysia.
            By accessing this website and/or using the services provided herein by TOHTONKU, you hereby consent to the
            exclusive jurisdiction of the Malaysian courts in Kuala Lumpur, Malaysia in all disputes arising out of or
            relating to the use of this website. <br />
            TOHTONKU makes no representation that the materials, information, functions and/or services provided on this
            website are appropriate or available for use in jurisdictions other than Malaysia.
          </p>
        </div>
      </div>
    </div>
  </section>


  @endsection