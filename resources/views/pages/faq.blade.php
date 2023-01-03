@extends('layouts.default')
@section('content')
    <head>
        <link href="{{ asset('css/faq.css') }}" rel="stylesheet">
        <title>FAQ</title>
    </head>

    <div class="content-wrapper">
        <div class="faq-title">
            <h3>FAQ</h3>
        </div>
        <div class="faq-wrapper">
            <div class="faq-box">
                <div class="faq-question">
                    <p>What is AutoBids?</p>
                </div>
                <div class="faq-answer">
                    <p>AutoBids is an online website that allows users to buy and sell vehicles through an auction system, ensuring the quality and authenticity of the vehicles.</p>
                </div>
            </div>
            <div class="faq-box">
                <div class="faq-question">
                    <p>How do I register?</p>
                </div>
                <div class="faq-answer">
                    <p>To register you need to fill out this <a href="/register">register form</a> signup form with your name, email, address and password.</p>
                </div>
            </div>
            <div class="faq-box">
                <div class="faq-question">
                    <p>How do I deposit money?</p>
                </div>
                <div class="faq-answer">
                    <p>To deposit money you need to transfer funds to our account and fill out this <a href="/transaction">transaction form</a>.</p>
                    <p>After the transaction is completed, our team will verify and credit your account.</p>
                </div>
            </div>

            <div class="faq-box">
                <div class="faq-question">
                    <p>How do I withdraw money?</p>
                </div>
                <div class="faq-answer">
                    <p>To withdraw money you need to fill out this <a href="/transaction">transaction form</a>.</p>
                    <p>Our team will verify and approve your transaction.</p>
                </div>
            </div>

            <div class="faq-box">
                <div class="faq-question">
                    <p>How do I create an auction?</p>
                </div>
                <div class="faq-answer">
                    <p>To create an auction you need to send your vehicle to our warehouse and fill out this <a href="/auctions/create">auction form</a>.</p>
                    <p>After we receive your vehicle and verify the information submitted the auction will be approved and shown on the website.</p>
                </div>
            </div>

            <div class="faq-box">
                <div class="faq-question">
                    <p>What is the minimun bid allowed?</p>
                </div>
                <div class="faq-answer">
                       <table class="table">
                           <thead>
                               <tr>
                                   <th scope="col">Current Bid</th>
                                   <th scope="col">Bid Increment</th>
                               </tr>
                           </thead>
                           <tbody>
                           <tr>
                               <td>$0.01-$0.99
                               </td>
                               <td>$0.05</td>
                           </tr>
                           <tr>
                               <td>$1.00-$4.99
                               </td>
                               <td>$0.25</td>
                           </tr>
                           <tr>
                               <td>$5.00-$24.99
                               </td>
                               <td>$0.50</td>
                           </tr>
                           <tr>
                               <td>
                                       $25.00-$99.99</td>
                               <td>$1.00</td>
                           </tr>
                           <tr>
                               <td>
                                       $100.00–$249.99</td>
                               <td>$2.50</td>
                           </tr>
                           <tr>
                               <td>
                                       $250.00–$499.99</td>
                               <td>$5.00</td>
                           </tr>
                           <tr>
                               <td>
                                       $500.00–$999.99</td>
                               <td>$10.00</td>
                           </tr>
                           <tr>
                               <td>
                                       $1,000.00–$2,499.99</td>
                               <td>$25.00</td>
                           </tr>
                           <tr>
                               <td>
                                       $2,500.00–$4,999.99</td>
                               <td>$50.00</td>
                           </tr>
                           <tr>
                               <td>$5,000.00 and up</td>
                               <td>$100.00</td>
                           </tr>
                           </tbody>
                       </table>


                </div>
            </div>
        </div>
    </div>
@stop
