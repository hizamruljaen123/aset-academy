            </div>
        </div>
    </div>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const faders = document.querySelectorAll('.transition-opacity');
  const options = { threshold: 0.1 };
  const observer = new IntersectionObserver((entries, obs) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('opacity-100');
        entry.target.classList.remove('opacity-0');
        obs.unobserve(entry.target);
      }
    });
  }, options);
  faders.forEach(el => observer.observe(el));
});
</script>
</body>
</html>