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

        // Updated prompt: AI returns 3 strategies in an array
        const prompt = `
You are an AI-powered investment education assistant.

RULES:
- You are NOT a licensed financial advisor.
- Do NOT guarantee returns.
- Do NOT mention specific stocks or cryptocurrencies.
- Output educational recommendations ONLY.
- Return EXACTLY three investment strategies: Conservative, Balanced, Aggressive.

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
Return ONLY valid JSON with this structure:

{
  "risk_profile_summary": "",
  "investment_options": [
    {
      "id": "conservative",
      "name": "Conservative",
      "description": "",
      "risk_level": "Low",
      "asset_allocation": [
        { "asset": "", "percentage": 0 },
        { "asset": "", "percentage": 0 },
        { "asset": "", "percentage": 0 }
      ],
      "suitable_for": "",
      "recommended": true
    },
    {
      "id": "balanced",
      "name": "Balanced",
      "description": "",
      "risk_level": "Medium",
      "asset_allocation": [
        { "asset": "", "percentage": 0 },
        { "asset": "", "percentage": 0 },
        { "asset": "", "percentage": 0 }
      ],
      "suitable_for": "",
      "recommended": false
    },
    {
      "id": "aggressive",
      "name": "Aggressive",
      "description": "",
      "risk_level": "High",
      "asset_allocation": [
        { "asset": "", "percentage": 0 },
        { "asset": "", "percentage": 0 },
        { "asset": "", "percentage": 0 }
      ],
      "suitable_for": "",
      "recommended": false
    }
  ],
  "ai_insights": [
    { "title": "", "description": "" },
    { "title": "", "description": "" }
  ],
  "recommended_strategy": "conservative",
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
        console.error("AI Generation Error:", error);
        res.status(500).json({
            success: false,
            message: "AI generation failed"
        });
    }
});

const PORT = process.env.PORT || 5000;
app.listen(PORT, () => {
    console.log(`Server running on port ${PORT}`);
});
