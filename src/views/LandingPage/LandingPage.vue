<template>
  <div class="min-h-screen bg-white font-['Inter']">
    <!-- Navigation -->
    <nav
      class="fixed top-0 w-full bg-white/95 backdrop-blur-sm border-b border-gray-100 z-50"
    >
      <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
          <div class="flex items-center gap-2 text-[#800000] font-bold text-xl">
            <i class="fas fa-chart-pie"></i>
            <span>Aura Invest</span>
          </div>

          <div class="hidden md:flex items-center gap-8">
            <a
              href="#home"
              class="text-gray-600 hover:text-[#800000] transition-colors font-medium"
              >Home</a
            >
            <a
              href="#features"
              class="text-gray-600 hover:text-[#800000] transition-colors font-medium"
              >Features</a
            >
            <a
              href="#about"
              class="text-gray-600 hover:text-[#800000] transition-colors font-medium"
              >About</a
            >
            <a
              href="#testimonials"
              class="text-gray-600 hover:text-[#800000] transition-colors font-medium"
              >Reviews</a
            >
            <a
              href="#blog"
              class="text-gray-600 hover:text-[#800000] transition-colors font-medium"
              >Blog</a
            >
          </div>

          <div class="flex items-center gap-4">
            <router-link
              to="/login"
              class="text-[#800000] font-semibold hover:text-[#600000] transition-colors"
            >
              Sign In
            </router-link>

            <router-link
              to="/register"
              class="bg-[#800000] text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-[#600000] transition-all hover:shadow-lg"
            >
              Get Started
            </router-link>
          </div>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <section
      id="home"
      class="pt-32 pb-20 px-6 lg:px-8 bg-gradient-to-b from-gray-50 to-white"
    >
      <div class="max-w-7xl mx-auto">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
          <div>
            <div
              class="inline-flex items-center gap-2 bg-[#800000]/10 text-[#800000] px-4 py-2 rounded-full text-sm font-semibold mb-6"
            >
              <i class="fas fa-star"></i>
              <span>Trusted by 2M+ investors</span>
            </div>
            <h1
              class="text-5xl lg:text-6xl font-bold text-[#0a1b2e] leading-tight mb-6"
            >
              Achieve Your Goals with Smart Financial Solutions
            </h1>
            <p class="text-gray-600 text-lg mb-8 leading-relaxed">
              Empower your financial journey with AI-driven insights,
              personalized investment strategies, and seamless portfolio
              management. Start building your wealth today.
            </p>
            <div class="flex flex-wrap gap-4">
              <button
                class="bg-[#800000] text-white px-8 py-4 rounded-lg font-semibold hover:bg-[#600000] transition-all hover:shadow-xl flex items-center gap-2"
              >
                Get Started
                <i class="fas fa-arrow-right"></i>
              </button>
              <button
                class="border-2 border-gray-200 text-gray-700 px-8 py-4 rounded-lg font-semibold hover:border-[#800000] hover:text-[#800000] transition-all flex items-center gap-2"
              >
                <i class="fas fa-play-circle"></i>
                See How It Works
              </button>
            </div>
          </div>

          <div class="relative">
            <div
              class="bg-white p-8 rounded-3xl shadow-2xl border border-gray-100"
            >
              <div class="flex items-center justify-between mb-6">
                <div>
                  <p class="text-gray-400 text-xs font-semibold uppercase mb-1">
                    Financial Growth
                  </p>
                  <p class="text-2xl font-bold text-[#0a1b2e]">2024</p>
                </div>
                <div class="text-right">
                  <p class="text-xs text-gray-400 mb-1">This Month</p>
                  <p class="text-lg font-bold text-green-500">+12.5%</p>
                </div>
              </div>
              <div
                class="h-48 bg-gradient-to-t from-[#800000]/5 to-transparent rounded-xl flex items-end gap-1 px-4"
              >
                <div
                  v-for="i in 12"
                  :key="i"
                  class="flex-1 bg-[#800000] rounded-t opacity-30 hover:opacity-60 transition-opacity"
                  :style="{ height: `${Math.random() * 70 + 30}%` }"
                ></div>
              </div>
            </div>

            <!-- Floating card -->
            <div
              class="absolute -bottom-6 -left-6 bg-white p-4 rounded-2xl shadow-xl border border-gray-100"
            >
              <div class="flex items-center gap-3">
                <div
                  class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center"
                >
                  <i class="fas fa-arrow-trend-up text-green-600 text-xl"></i>
                </div>
                <div>
                  <p class="text-xs text-gray-400">Portfolio Value</p>
                  <p class="font-bold text-lg">$125,430</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Trusted By Section -->
    <section class="py-12 bg-white border-y border-gray-100">
      <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <p
          class="text-center text-gray-400 text-sm font-semibold uppercase mb-8"
        >
          Trusted Platforms
        </p>
        <div
          class="flex flex-wrap justify-center items-center gap-12 opacity-40"
        >
          <i class="fab fa-google text-4xl"></i>
          <i class="fab fa-apple text-4xl"></i>
          <i class="fab fa-microsoft text-4xl"></i>
          <i class="fab fa-stripe text-4xl"></i>
          <i class="fab fa-paypal text-4xl"></i>
          <i class="fab fa-amazon text-4xl"></i>
        </div>
      </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-gray-50">
      <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
          <div v-for="(stat, index) in stats" :key="index" class="text-center">
            <p class="text-5xl font-extrabold text-[#800000] mb-2">
              {{ stat.value }}
            </p>
            <p class="text-gray-600 font-medium">{{ stat.label }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
      <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold text-[#0a1b2e] mb-4">
            Your Path to Financial Freedom
          </h2>
          <p class="text-gray-600 text-lg max-w-2xl mx-auto">
            Discover powerful tools and features designed to help you achieve
            your financial goals faster and smarter.
          </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
          <div
            v-for="(feature, index) in features"
            :key="index"
            class="bg-gray-50 p-8 rounded-3xl hover:bg-white hover:shadow-xl transition-all border border-transparent hover:border-gray-100 group"
          >
            <div
              class="w-16 h-16 bg-[#800000]/10 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#800000] transition-all"
            >
              <i
                :class="feature.icon"
                class="text-2xl text-[#800000] group-hover:text-white transition-all"
              ></i>
            </div>
            <h3 class="text-xl font-bold text-[#0a1b2e] mb-3">
              {{ feature.title }}
            </h3>
            <p class="text-gray-600 leading-relaxed">
              {{ feature.description }}
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Exclusive Features Section -->
    <section class="py-20 bg-gradient-to-br from-gray-50 to-white">
      <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
          <div>
            <h2 class="text-4xl font-bold text-[#0a1b2e] mb-6">
              Unlock Exclusive Features
            </h2>
            <p class="text-gray-600 text-lg mb-8 leading-relaxed">
              Take control of your finances with advanced analytics and
              intelligent expense tracking.
            </p>

            <div class="space-y-6">
              <div
                v-for="(feature, index) in exclusiveFeatures"
                :key="index"
                class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition-all"
              >
                <div class="flex items-start gap-4">
                  <div
                    class="w-12 h-12 bg-[#800000]/10 rounded-xl flex items-center justify-center flex-shrink-0"
                  >
                    <i :class="feature.icon" class="text-xl text-[#800000]"></i>
                  </div>
                  <div class="flex-1">
                    <h3 class="font-bold text-lg text-[#0a1b2e] mb-2">
                      {{ feature.title }}
                    </h3>
                    <p class="text-gray-600 text-sm">
                      {{ feature.description }}
                    </p>
                  </div>
                  <div class="text-2xl font-bold text-[#800000]">
                    {{ feature.highlight }}
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="relative">
            <div
              class="bg-gradient-to-br from-[#800000] to-[#600000] p-8 rounded-3xl text-white"
            >
              <h3 class="text-2xl font-bold mb-4">Income analytics</h3>
              <p class="text-white/80 mb-8">
                Track your income sources and optimize your revenue streams with
                intelligent forecasting.
              </p>
              <div
                class="bg-white/10 backdrop-blur-sm p-6 rounded-2xl border border-white/20"
              >
                <p class="text-white/60 text-sm mb-2">Total Income</p>
                <p class="text-4xl font-bold mb-4">$95.00</p>
                <div class="h-32 flex items-end gap-2">
                  <div
                    v-for="i in 8"
                    :key="i"
                    class="flex-1 bg-white/30 rounded-t hover:bg-white/50 transition-all"
                    :style="{ height: `${Math.random() * 80 + 20}%` }"
                  ></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-20 bg-white">
      <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold text-[#0a1b2e] mb-4">
            See Our Customer Review
          </h2>
          <p class="text-gray-600 text-lg max-w-2xl mx-auto">
            Join thousands of satisfied investors who have transformed their
            financial future with Aura Invest.
          </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
          <div
            v-for="(testimonial, index) in testimonials"
            :key="index"
            class="bg-gray-50 p-6 rounded-2xl hover:bg-white hover:shadow-xl transition-all border border-transparent hover:border-gray-100"
          >
            <div class="flex gap-1 mb-4">
              <i
                v-for="star in testimonial.rating"
                :key="star"
                class="fas fa-star text-yellow-400"
              ></i>
            </div>
            <p class="text-gray-600 text-sm mb-6 leading-relaxed">
              {{ testimonial.text }}
            </p>
            <div class="flex items-center gap-3">
              <img
                :src="testimonial.avatar"
                :alt="testimonial.name"
                class="w-10 h-10 rounded-full"
              />
              <div>
                <p class="font-bold text-sm text-[#0a1b2e]">
                  {{ testimonial.name }}
                </p>
                <p class="text-gray-400 text-xs">{{ testimonial.role }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Blog Section -->
    <section id="blog" class="py-20 bg-gray-50">
      <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex justify-between items-end mb-12">
          <div>
            <h2 class="text-4xl font-bold text-[#0a1b2e] mb-4">
              The Finance Hub
            </h2>
            <p class="text-gray-600 text-lg">
              Latest insights and tips to help you manage your finances better.
            </p>
          </div>
          <button
            class="bg-[#800000] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#600000] transition-all hover:shadow-lg hidden md:block"
          >
            View All Articles
          </button>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
          <div
            v-for="(post, index) in blogPosts"
            :key="index"
            class="bg-white rounded-2xl overflow-hidden hover:shadow-xl transition-all group cursor-pointer"
          >
            <div class="relative h-48 overflow-hidden">
              <img
                :src="post.image"
                :alt="post.title"
                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
              />
              <div
                class="absolute top-4 left-4 bg-white px-3 py-1 rounded-full text-xs font-semibold"
              >
                {{ post.category }}
              </div>
            </div>
            <div class="p-6">
              <h3
                class="font-bold text-lg text-[#0a1b2e] mb-2 group-hover:text-[#800000] transition-colors"
              >
                {{ post.title }}
              </h3>
              <p class="text-gray-600 text-sm mb-4">
                Discover powerful strategies to improve your financial health
                and achieve your goals.
              </p>
              <a
                href="#"
                class="text-[#800000] font-semibold text-sm flex items-center gap-2 hover:gap-3 transition-all"
              >
                Read More <i class="fas fa-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-white">
      <div class="max-w-4xl mx-auto px-6 lg:px-8">
        <div
          class="bg-gradient-to-br from-[#800000] to-[#600000] rounded-3xl p-12 text-center text-white relative overflow-hidden"
        >
          <div
            class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"
          ></div>
          <div
            class="absolute bottom-0 left-0 w-64 h-64 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2"
          ></div>

          <div class="relative z-10">
            <h2 class="text-4xl font-bold mb-4">Join Our Community Today</h2>
            <p class="text-white/90 text-lg mb-8 max-w-2xl mx-auto">
              Start your journey to financial freedom. Get personalized
              investment strategies, AI-powered insights, and 24/7 support.
            </p>
            <button
              class="bg-white text-[#800000] px-8 py-4 rounded-lg font-bold hover:bg-gray-100 transition-all hover:shadow-2xl"
            >
              Get Started Now
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#0a1b2e] text-white py-16">
      <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid md:grid-cols-2 lg:grid-cols-5 gap-12 mb-12">
          <div class="lg:col-span-2">
            <div
              class="flex items-center gap-2 text-[#800000] font-bold text-xl mb-4"
            >
              <i class="fas fa-chart-pie"></i>
              <span>Aura Invest</span>
            </div>
            <p class="text-gray-400 mb-6 leading-relaxed">
              Empowering millions of investors worldwide with intelligent
              financial solutions and personalized investment strategies.
            </p>
            <div class="flex gap-3">
              <a
                href="#"
                class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-[#800000] transition-all"
              >
                <i class="fab fa-facebook-f"></i>
              </a>
              <a
                href="#"
                class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-[#800000] transition-all"
              >
                <i class="fab fa-twitter"></i>
              </a>
              <a
                href="#"
                class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-[#800000] transition-all"
              >
                <i class="fab fa-linkedin-in"></i>
              </a>
              <a
                href="#"
                class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-[#800000] transition-all"
              >
                <i class="fab fa-instagram"></i>
              </a>
            </div>
          </div>

          <div>
            <h4 class="font-bold mb-4">Resources</h4>
            <ul class="space-y-3">
              <li>
                <a
                  href="#"
                  class="text-gray-400 hover:text-white transition-colors"
                  >Blog</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-400 hover:text-white transition-colors"
                  >Help Center</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-400 hover:text-white transition-colors"
                  >Guides</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-400 hover:text-white transition-colors"
                  >Webinars</a
                >
              </li>
            </ul>
          </div>

          <div>
            <h4 class="font-bold mb-4">Product</h4>
            <ul class="space-y-3">
              <li>
                <a
                  href="#"
                  class="text-gray-400 hover:text-white transition-colors"
                  >Features</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-400 hover:text-white transition-colors"
                  >Pricing</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-400 hover:text-white transition-colors"
                  >Security</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-400 hover:text-white transition-colors"
                  >Enterprise</a
                >
              </li>
            </ul>
          </div>

          <div>
            <h4 class="font-bold mb-4">Company</h4>
            <ul class="space-y-3">
              <li>
                <a
                  href="#"
                  class="text-gray-400 hover:text-white transition-colors"
                  >About Us</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-400 hover:text-white transition-colors"
                  >Careers</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-400 hover:text-white transition-colors"
                  >Press Kit</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-400 hover:text-white transition-colors"
                  >Contact</a
                >
              </li>
            </ul>
          </div>
        </div>

        <div
          class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4"
        >
          <p class="text-gray-400 text-sm">
            © 2024 Aura Invest. All rights reserved.
          </p>
          <div class="flex gap-6 text-sm">
            <a href="#" class="text-gray-400 hover:text-white transition-colors"
              >Privacy Policy</a
            >
            <a href="#" class="text-gray-400 hover:text-white transition-colors"
              >Terms of Service</a
            >
            <a href="#" class="text-gray-400 hover:text-white transition-colors"
              >Cookie Policy</a
            >
          </div>
        </div>
      </div>
    </footer>
    <!-- Chat Window -->
    <div
      v-if="showChat"
      class="fixed bottom-24 right-6 w-80 h-96 bg-white rounded-2xl shadow-2xl border border-gray-200 flex flex-col overflow-hidden z-50"
    >
      <!-- Header -->
      <div
        class="bg-[#800000] text-white px-4 py-3 flex justify-between items-center"
      >
        <span>Aurex Chat</span>
        <button @click="toggleChat" class="text-white">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <!-- Messages -->
      <div class="flex-1 p-4 overflow-y-auto space-y-3" ref="messagesContainer">
        <div
          v-for="(msg, index) in messages"
          :key="index"
          :class="msg.role === 'user' ? 'text-right' : 'text-left'"
        >
          <div
            :class="
              msg.role === 'user'
                ? 'inline-block bg-[#800000]/20 text-[#0a1b2e] px-3 py-2 rounded-xl'
                : 'inline-block bg-gray-100 text-[#0a1b2e] px-3 py-2 rounded-xl'
            "
          >
            {{ msg.text }}
          </div>
        </div>
      </div>

      <!-- Input -->
      <div class="px-4 py-2 border-t border-gray-200 flex gap-2">
        <input
          v-model="userInput"
          @keyup.enter="sendMessage"
          placeholder="Type your message..."
          class="flex-1 border border-gray-200 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#800000]"
        />
        <button
          @click="sendMessage"
          class="bg-[#800000] text-white px-4 py-2 rounded-full hover:bg-[#600000] transition-all"
        >
          Send
        </button>
      </div>
    </div>
  </div>
  <!-- Floating Chat Button -->
  <div class="fixed bottom-6 right-6 z-50">
    <button
      @click="toggleChat"
      class="w-16 h-16 bg-[#800000] text-white rounded-full shadow-lg flex items-center justify-center hover:bg-[#600000] transition-all"
    >
      <i class="fas fa-comments text-2xl"></i>
    </button>
  </div>
</template>

<script setup>
import { ref, nextTick } from "vue";

const showChat = ref(false);
const userInput = ref("");
const messages = ref([]);

// Toggle chat window
const toggleChat = () => {
  showChat.value = !showChat.value;
};

// Send message
const sendMessage = async () => {
  if (!userInput.value.trim()) return;

  // Add user message
  messages.value.push({ role: "user", text: userInput.value });

  // Scroll down
  await nextTick();
  scrollToBottom();

  // Save input locally then clear
  const messageToSend = userInput.value;
  userInput.value = "";

  try {
    // Call your Node AI backend
    const response = await fetch("http://localhost:5000/api/chat", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ message: messageToSend }),
    });
    const data = await response.json();
    messages.value.push({ role: "bot", text: data.reply });

    await nextTick();
    scrollToBottom();
  } catch (err) {
    console.error(err);
    messages.value.push({ role: "bot", text: "Oops! Something went wrong." });
  }
};

const messagesContainer = ref(null);
const scrollToBottom = () => {
  if (messagesContainer.value) {
    messagesContainer.value.scrollTop = messagesContainer.value.scrollHeight;
  }
};

const stats = [
  { value: "2M+", label: "Active Users" },
  { value: "98%", label: "Satisfaction Rate" },
  { value: "85+", label: "Countries" },
  { value: "4.8", label: "Average Rating" },
];

const features = [
  {
    icon: "fas fa-comments-dollar",
    title: "Credit Counseling",
    description:
      "Get expert financial advice tailored to your unique situation and goals.",
  },
  {
    icon: "fas fa-piggy-bank",
    title: "Savings Accounts",
    description: "High-yield savings accounts to help your money grow faster.",
  },
  {
    icon: "fas fa-chart-line",
    title: "Investment Planning",
    description:
      "Smart investment strategies designed for long-term wealth building.",
  },
];

const exclusiveFeatures = [
  {
    icon: "fas fa-wallet",
    title: "Expense management",
    description:
      "Track and categorize your spending with intelligent insights.",
    highlight: "$95.00",
  },
  {
    icon: "fas fa-chart-pie",
    title: "Payment analytics",
    description:
      "Visualize your financial patterns and make informed decisions.",
    highlight: "Analytics",
  },
];

const testimonials = [
  {
    name: "Brooklyn Simmons",
    role: "Entrepreneur",
    avatar: "https://i.pravatar.cc/150?u=brooklyn",
    rating: 5,
    text: "Aura Invest transformed my financial life. The AI-powered insights helped me save 30% more than I expected!",
  },
  {
    name: "Jenny Wilson",
    role: "Designer",
    avatar: "https://i.pravatar.cc/150?u=jenny",
    rating: 5,
    text: "The platform is incredibly intuitive. I finally feel in control of my investments and retirement planning.",
  },
  {
    name: "Eliana White",
    role: "Software Engineer",
    avatar: "https://i.pravatar.cc/150?u=eliana",
    rating: 5,
    text: "Best investment platform I've used. The customer support is exceptional and the tools are top-notch.",
  },
  {
    name: "Jordan Peterson",
    role: "Business Owner",
    avatar: "https://i.pravatar.cc/150?u=jordan",
    rating: 5,
    text: "Simple, powerful, and effective. Aura Invest made investing accessible and profitable for me.",
  },
];

const blogPosts = [
  {
    title: "Insight about money",
    image:
      "https://images.unsplash.com/photo-1554224311-beee4ece8db7?w=800&q=80",
    category: "Finance Tips",
  },
  {
    title: "Manage your budget",
    image:
      "https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?w=800&q=80",
    category: "Money Management",
  },
  {
    title: "Invest for future",
    image:
      "https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&q=80",
    category: "Investment",
  },
];
</script>
