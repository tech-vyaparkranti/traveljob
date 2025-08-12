@extends('layouts.webSite')
@section('title', 'Terms & Conditions')
@section('content')
    <style>
        /* General Body Styles */
      
        /* Main Content Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px;
            border-radius: 8px;
        }

        /* Headings */
        h1 {
            font-size: 2em;
            color: #1a202c;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 1.5em;
            color: #2d3748;
            margin-top: 40px;
            margin-bottom: 15px;
        }

        h3 {
            font-size: 1.1em;
            color: #4a5568;
            margin-top: 25px;
            font-weight: bold;
        }

        /* Paragraph and List Styling */
        p, li {
            font-size: 1rem;
            color: #4a5568;
            text-align: justify;
        }

        ul {
            padding-left: 20px;
        }

        li {
            margin-bottom: 10px;
        }

        strong {
            color: #2d3748;
        }

        /* Placeholder for items to be filled in */
        .placeholder {
            color: #e53e3e;
            font-style: italic;
            font-weight: bold;
        }

        /* Special notice box styling */
        .notice-box {
            background-color: #fefcbf; /* Light yellow */
            border-left: 4px solid #f6e05e; /* Yellow border */
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }

        /* Signature Section Styling */
        .signature-section {
            margin-top: 50px;
            border-top: 1px solid #e2e8f0;
            padding-top: 30px;
        }
        
        .signature-line-container {
            margin-top: 40px;
        }
        
        .signature-line {
            border-bottom: 1px solid #333;
            height: 20px;
            width: 250px;
        }

        .signature-fields {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }

    </style>

    <div class="container">
        <h1 style="color:#030358">Terms and Conditions</h1>

        <p><strong>Welcome to Traveljobs.info</strong> (the “Platform”), an online recruitment portal operated by <span class="placeholder">Traveljobs.info</span> These Terms and Conditions of Usage (“Terms”) govern your access to and use of the Traveljobs.info website, mobile applications, and related services (collectively, the “Services”). By accessing or using the Platform, you agree to be bound by these Terms. If you do not agree, please refrain from using the Services.</p>

        <h2>1. Definitions</h2>
        <p><strong>User:</strong> Any individual or entity accessing the Platform, including but not limited to job seekers, employers, recruiters, or administrators.</p>
        <p><strong>Job Seeker:</strong> An individual using the Platform to search for or apply to job opportunities in the travel industry.</p>
        <p><strong>Employer:</strong> A company, organization, or individual using the Platform to post job listings or recruit candidates.</p>
        <p><strong>Content:</strong> Any information, text, graphics, or other materials uploaded, posted, or shared on the Platform by Users.</p>
        <p><strong>Services:</strong> All features, functionalities, and tools provided by Traveljobs.info, including job postings, candidate applications, and communication tools.</p>

        <h2>2. Eligibility</h2>
        <ul>
            <li>You must be at least 18 years old or the age of legal majority in your jurisdiction to use the Platform.</li>
            <li>Employers must be legally authorized entities or individuals with the capacity to enter into binding agreements.</li>
            <li>By using the Services, you represent and warrant that you meet these eligibility requirements and have the legal capacity to agree to these Terms.</li>
        </ul>

        <h2>3. User Accounts</h2>
        <h3>Account Creation:</h3>
        <p>To access certain features, Users must create an account by providing accurate, complete, and up-to-date information (e.g., name, email, and professional details).</p>
        <h3>Account Security:</h3>
        <p>You are responsible for maintaining the confidentiality of your account credentials and for all activities conducted under your account.</p>
        <h3>Account Accuracy:</h3>
        <p>You agree to promptly update your account information to ensure its accuracy. Traveljobs.info is not responsible for issues arising from outdated or inaccurate information.</p>
        <h3>Account Termination:</h3>
        <p>We reserve the right to suspend or terminate accounts for violations of these Terms, fraudulent activity, or misuse of the Platform.</p>

        <h2>4. Use of the Platform</h2>
        <h3>Permitted Use:</h3>
        <p>The Platform may be used solely for lawful purposes related to job searching, recruitment, or related activities within the travel industry.</p>
        <h3>Prohibited Activities:</h3>
        <p>You agree not to:</p>
        <ul>
            <li>Post false, misleading, or fraudulent job listings or candidate profiles.</li>
            <li>Use the Platform for illegal activities, including discrimination, harassment, or violation of labor laws.</li>
            <li>Upload or share Content that is defamatory, obscene, offensive, or infringes on intellectual property rights.</li>
            <li>Attempt to hack, disrupt, or interfere with the Platform’s functionality, including through viruses, malware, or unauthorized access.</li>
            <li>Scrape, copy, or reproduce Platform Content without prior written consent.</li>
        </ul>
        <h3>Compliance with Laws:</h3>
        <p>Users must comply with all applicable local, national, and international laws, including employment and data protection regulations.</p>

        <h2>5. Job Postings and Applications</h2>
        <h3>Employer Responsibilities:</h3>
        <ul>
            <li>Employers must provide accurate, lawful, and non-discriminatory job listings.</li>
            <li>Employers are solely responsible for verifying candidate qualifications and conducting due diligence.</li>
            <li>TravelJobs’ recommendation of a candidate is based solely on the candidate’s skills as presented in their profile. This recommendation does not reflect any assessment of the candidate’s character, job loyalty, or previous employment history. It is the sole responsibility of the employer to conduct all necessary background checks and verify the candidate’s suitability for the proposed job assignment.</li>
            <li>Job postings must comply with applicable labor laws and regulations in the relevant jurisdiction.</li>
        </ul>
        <h3>Job Seeker Responsibilities:</h3>
        <ul>
            <li>Job Seekers must submit truthful and accurate information in their profiles and applications.</li>
            <li>Job Seekers are responsible for ensuring their qualifications match job requirements before applying.</li>
        </ul>
        <div class="notice-box">
            <strong>Important Notice to Job Seekers:</strong><br>
            TravelJobs’ role is limited to recommending your profile to prospective employers. We do not guarantee a job offer, as the decision to hire rests solely with the employer and is based on your performance in interviews, tests, and other assessments including background check conducted by them. Please also note that if you are selected and join the position, the continuation of your employment will depend entirely on your performance and your ability to meet the employer’s expectations. TravelJobs does not take responsibility for, nor can we assure, continued employment.
        </div>
        <h3>Platform Role:</h3>
        <p>Traveljobs.info acts as an intermediary facilitating connections between Employers and Job Seekers. We do not guarantee the accuracy of Content, the suitability of candidates, or the fulfilment of job offers.</p>

        <h2>6. Content Ownership and Licensing</h2>
        <h3>User Content:</h3>
        <p>You retain ownership of Content you upload to the Platform (e.g., resumes, job listings). By uploading Content, you grant Traveljobs.info a non-exclusive, worldwide, royalty-free license to use, store, display, and distribute such Content solely for the purpose of operating and promoting the Platform.</p>
        <h3>Platform Content:</h3>
        <p>All intellectual property, including logos, designs, and software on the Platform, is owned by or licensed to Traveljobs.info. Users may not copy, modify, or distribute Platform Content without written permission.</p>
        <h3>Content Removal:</h3>
        <p>We reserve the right to remove any Content that violates these Terms or is deemed inappropriate, at our sole discretion.</p>

        <h2>7. Fees and Payments</h2>
        <h3>Free and Paid Services:</h3>
        <p>Certain features of the Platform may be available for free, while others (e.g., premium job postings or enhanced visibility) may require payment.</p>
        <h3>Payment Terms:</h3>
        <p>Employers agree to pay applicable fees as outlined during the purchase process. All payments are non-refundable unless otherwise stated.</p>
        <h3>Taxes:</h3>
        <p>Users are responsible for any applicable taxes arising from their use of the Services.</p>

        <h2>8. Privacy and Data Protection</h2>
        <h3>Data Collection:</h3>
        <p>We collect and process personal data in accordance with our Privacy Policy. By using the Platform, you consent to such processing.</p>
        <h3>Data Sharing:</h3>
        <p>Job Seeker data may be shared with Employers as part of the application process. Employers agree to use such data solely for recruitment purposes and in compliance with applicable data protection laws.</p>
        <h3>Data Security:</h3>
        <p>We implement reasonable measures to protect User data but cannot guarantee absolute security. Users are encouraged to safeguard their own sensitive information.</p>

        <h2>9. Disclaimers</h2>
        <h3>No Employment Guarantee:</h3>
        <p>Traveljobs.info does not guarantee job placements, interviews, or employment outcomes for Job Seekers, nor does it guarantee candidate quality for Employers.</p>
        <h3>Third-Party Links:</h3>
        <p>The Platform may contain links to third-party websites or services. We are not responsible for the content or practices of such third parties.</p>
        <h3>Service Availability:</h3>
        <p>We strive to maintain uninterrupted access to the Platform but do not guarantee that the Services will be error-free or available at all times.</p>

        <h2>10. Limitation of Liability</h2>
        <p>To the fullest extent permitted by law, Traveljobs.info and its affiliates, officers, employees, or agents shall not be liable for any indirect, incidental, consequential, or punitive damages arising from your use of the Platform.</p>
        <p>Our total liability for any claim related to the Services shall not exceed the amount paid by you (if any) for accessing the Platform in the preceding 12 months.</p>

        <h2>11. Indemnification</h2>
        <p>You agree to indemnify and hold harmless Traveljobs.info, its affiliates, and their respective officers, employees, and agents from any claims, losses, or damages arising from your breach of these Terms, misuse of the Platform, or violation of any third-party rights.</p>

        <h2>12. Termination</h2>
        <h3>User Termination:</h3>
        <p>You may stop using the Platform at any time and request account deletion by contacting us .</p>
        <h3>Platform Termination:</h3>
        <p>We may suspend or terminate your access to the Platform for violations of these Terms, suspected fraud, or other reasons at our discretion.</p>
        <h3>Effect of Termination:</h3>
        <p>Upon termination, your right to access the Services ceases, but these Terms’ provisions on liability, indemnification, and intellectual property survive.</p>

        <h2>13. Modifications to Terms</h2>
        <p>We reserve the right to modify these Terms at any time. Updated Terms will be posted on the Platform with the “Last Updated” date. Continued use of the Services after changes constitutes acceptance of the revised Terms.</p>
        <p>Significant changes will be communicated to Users via email or Platform notifications, where feasible.</p>

       

        <h2>14. Miscellaneous</h2>
        <h3>Entire Agreement:</h3>
        <p>These Terms, along with the Privacy Policy and any other agreements referenced herein, constitute the entire agreement between you and Traveljobs.info.</p>
        <h3>Severability:</h3>
        <p>If any provision of these Terms is found unenforceable, the remaining provisions will remain in full effect.</p>
        <h3>Assignment:</h3>
        <p>You may not assign your rights or obligations under these Terms without our prior written consent. We may assign these Terms at our discretion.</p>
        <h3>Force Majeure:</h3>
        <p>We are not liable for delays or failures in performance due to events beyond our reasonable control (e.g., natural disasters, cyberattacks).</p>

       
    </div>


@endsection