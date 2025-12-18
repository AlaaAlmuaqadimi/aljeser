
    const menuToggle = document.getElementById('menuToggle');
    const mainNav = document.getElementById('mainNav');

    menuToggle.addEventListener('click', () => {
      mainNav.classList.toggle('open');
    });

    const navLinks = document.querySelectorAll('#mainNav a[href^="#"]');
    const sections = [...navLinks].map(link => document.querySelector(link.getAttribute('href')));

    window.addEventListener('scroll', () => {
      const scrollPos = window.scrollY + 120;
      sections.forEach((section, idx) => {
        if (!section) return;
        if (scrollPos >= section.offsetTop && scrollPos < section.offsetTop + section.offsetHeight) {
          navLinks.forEach(a => a.classList.remove('active'));
          navLinks[idx].classList.add('active');
        }
      });
    }); 
  
  function showToast() {
    const toast = document.getElementById("toastCenter");
    toast.classList.add("show");           // لو عندك CSS يعتمد show
    toast.style.display = "flex";          // احتياط لو كان مخفي
    setTimeout(() => {
      toast.classList.remove("show");
      toast.style.display = "none";
    }, 3000);
  }

  async function sendForm() {
    const form = document.getElementById("contactForm");

    try {
      const res = await fetch("/send_mail.php", {   // اسم ملف الـPHP
        method: "POST",
        body: new FormData(form)
      });

      const data = await res.json();

      if (data.ok) {
        showToast();      // ✅ التوست يشتغل بعد نجاح الإرسال
        form.reset();
      } else {
        alert(data.error || "صار خطأ أثناء الإرسال");
      }
    } catch (e) {
      alert("تعذر الاتصال بالسيرفر، حاول مرة أخرى.");
    }
  } 
