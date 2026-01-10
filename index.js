import express from "express";
import dotenv from "dotenv";
import { GoogleGenerativeAI } from "@google/generative-ai";
import cors from "cors";




dotenv.config();

const app = express();
app.use(cors());
app.use(express.json());

const genAI = new GoogleGenerativeAI(process.env.GEMINI_API_KEY);

const model = genAI.getGenerativeModel({
    model: "gemini-2.5-flash-lite"
});

app.post("/api/recommend", async (req, res) => {
    try {
    const {
    age,
    country,
    income,
    amount,
    risk,
    goal,
    horizon,
    experience
    } = req.body;

    const prompt = `
You are an AI-powered investment education assistant.

RULES:
- You are not a licensed financial advisor.
- Do not guarantee returns.
- Do not mention specific stocks or cryptocurrencies.
- Output educational recommendations only.

USER PROFILE:
Age: ${age}
Country: ${country}
Monthly Income: ${income}
Investment Amount: ${amount}
Risk Tolerance: ${risk}
Investment Goal: ${goal}
Time Horizon: ${horizon} years
Experience Level: ${experience}

RESPONSE FORMAT:
Return ONLY valid JSON in this structure:

{
"risk_profile_summary": "",
"recommended_strategy": "",
"suggested_asset_allocation": {
"low_risk_assets_percent": "",
"medium_risk_assets_percent": "",
"high_risk_assets_percent": ""
},
"time_horizon_plan": "",
"risk_management_tips": [
    "",
    "",
    ""
],
"disclaimer": ""
}
`;

    const result = await model.generateContent(prompt);
    const text = result.response.text();

    const cleanText = text
    .replace(/```json/g, "")
    .replace(/```/g, "")
    .trim();

const data = JSON.parse(cleanText);


    res.json({
    success: true,
    recommendation: data
    });

    } catch (error) {
    console.error(error);
    res.status(500).json({
    success: false,
    message: "AI generation failed"
    });
    }
});

app.listen(process.env.PORT, () => {
    console.log(`Server running on port ${process.env.PORT}`);
});
