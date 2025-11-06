<?php
// index.php — PSLE Results API Documentation
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSLE Results API Documentation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f9fc;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        header {
            background: #004aad;
            color: white;
            padding: 20px;
            text-align: center;
        }
        h1 {
            margin: 0;
            font-size: 26px;
        }
        main {
            max-width: 900px;
            margin: 30px auto;
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        code {
            background: #f1f1f1;
            padding: 4px 8px;
            border-radius: 5px;
            color: #c7254e;
        }
        pre {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 10px;
            overflow-x: auto;
        }
        .example {
            background: #eef9ff;
            border-left: 4px solid #004aad;
            padding: 15px;
            margin: 20px 0;
            border-radius: 6px;
        }
        footer {
            text-align: center;
            font-size: 14px;
            color: #666;
            padding: 20px;
            margin-top: 40px;
        }
        a {
            color: #004aad;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<header>
    <h1>🧾 PSLE Results API Documentation</h1>
    <p>Hosted at <strong>psle.tetea.store</strong></p>
</header>

<main>
    <h2>1️⃣ Student Result API — <code>psle.php</code></h2>
    <p>This endpoint returns a specific student’s result in <b>JSON format</b>.</p>

    <div class="example">
        <b>Endpoint:</b><br>
        <code>https://psle.tetea.store/psle.php?year=2024&school=PS0401058&index=0001</code>
    </div>

    <p><b>Parameters:</b></p>
    <ul>
        <li><code>year</code> → Exam year (e.g. 2024)</li>
        <li><code>school</code> → School number (e.g. PS0401058)</li>
        <li><code>index</code> → Candidate index (e.g. 0001)</li>
    </ul>

    <p><b>Sample Response:</b></p>
    <pre>{
  "year": "2024",
  "school": "PS0401058",
  "index": "0001",
  "candidate_no": "PS0401058-0001",
  "prem_no": "P12345",
  "sex": "F",
  "subjects": "Kiswahili - A, English - B, Science - B, Average Grade - B"
}</pre>

    <hr>

    <h2>2️⃣ School Results Page — <code>school_result.php</code></h2>
    <p>This endpoint displays all student results for a school in a formatted HTML table.</p>

    <div class="example">
        <b>Endpoint:</b><br>
        <code>https://psle.tetea.store/school_result.php?year=2024&school=PS0401058</code>
    </div>

    <p><b>Parameters:</b></p>
    <ul>
        <li><code>year</code> → Exam year</li>
        <li><code>school</code> → School number</li>
    </ul>

    <p><b>Example Use:</b> View in browser to see the full school’s results table.</p>

    <hr>

    <h2>3️⃣ Notes</h2>
    <ul>
        <li>Data is fetched directly from official NECTA or TETEA archives.</li>
        <li>Supports years 2016 → 2025.</li>
        <li>If data is not found, JSON or HTML error messages are returned.</li>
    </ul>

    <h2>4️⃣ Quick Try</h2>
    <p>You can test directly here:</p>
    <form method="get" action="psle.php" target="_blank">
        <label>Year: <input type="text" name="year" value="2024" required></label>
        <label>School: <input type="text" name="school" value="PS0401058" required></label>
        <label>Index: <input type="text" name="index" value="0001" required></label>
        <button type="submit">🔍 Get Student Result (JSON)</button>
    </form>

    <form method="get" action="school_result.php" target="_blank" style="margin-top:10px;">
        <label>Year: <input type="text" name="year" value="2024" required></label>
        <label>School: <input type="text" name="school" value="PS0401058" required></label>
        <button type="submit">🏫 View School Results (HTML)</button>
    </form>
</main>

<footer>
    © <?= date('Y'); ?> PSLE Results API | Developed by <a href="https://pestscode.com" target="_blank">PestsCode</a>
</footer>

</body>
</html>
