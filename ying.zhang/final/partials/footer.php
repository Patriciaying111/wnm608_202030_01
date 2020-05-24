<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <style>
            .subscribe-container {
                display: flex;
                justify-content: center;
                align-items: center;
                margin-top:24px;
            }

            .subscribe-input {
                width: 400px;
                height: 40px;
                font-size: 18px;
            }

            .subscribe-input:focus {
                outline: none;
            }

            .subscribe-button {
                width: 120px;
                height: 40px;
                cursor: pointer;
                background-color: #fff;
                color: #000;
                font-size: 18px;
                font-weight: 600;
            }

            @media (max-width:600px) {
                .subscribe-container {
                    display: flex;
                    flex-direction: column;
                    width: 80%;
                }
                .subscribe-input {
                    width: 100%;
                }
                .subscribe-button {
                    margin-top:16px;
                }
            }
        </style>
    </head>

    <body>
        <div class="footer">
            <div style='font-size:18px; font-weight: 600'>
                Subscribe for latest update
            </div>
            <div style='display:flex; justify-content:center'>
                <div class='subscribe-container'>
                    <input class='subscribe-input' />
                    <button class='subscribe-button'>Submit</button>
                </div>
            </div>
            <div style='margin-top:24px; line-height:1.5'>2173 21st Avenue, San Francisco, CA</div>
            <div style='margin-top:24px; line-height:1.5'>
                <div>
                    <i class='fa'>&#xf230;</i>
                    <i class='fa'>&#xf16d;</i>
                    <i class='fa'>&#xf081;</i>
                    <i class='fa'>&#xf1d7;</i>
                </div>

                <div style='line-height:1.5'>
                    <!--<i class='fa'>&#xf642;</i>-->
                    <i class='fa'>&#xf1f4;</i>
                    <i class='fa'>&#xf1f0;</i>
                </div>
            </div>
        </div>

        <div style='width: 100%; height:60px; display:flex; justify-content:center; align-items:center;background-color: #fff; color: #000'>
            &copy; 2020 Patricia All Rights Reserved.
        </div>
    </body>
</html>