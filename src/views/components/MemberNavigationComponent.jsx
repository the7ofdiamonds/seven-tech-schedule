function MemberNavigationComponent(props) {
  const { resume } = props;

  const portfolioElement = document.getElementById('portfolio');

  const scrollToSection = (sectionId) => {
    const section = document.getElementById(sectionId);

    if (section) {
      const offsetTopPx = section.getBoundingClientRect().top + window.scrollY;
      const paddingTopPx = 137.5;
      const rootFontSize = parseFloat(
        getComputedStyle(document.documentElement).fontSize
      );

      const paddingTopRem = paddingTopPx / 16;
      const paddingTopBackToPx = paddingTopRem * rootFontSize;
      const topPx = offsetTopPx - paddingTopBackToPx;

      window.scrollTo({
        top: topPx,
        behavior: 'smooth',
      });
    }
  };

  const openResumeInNewTab = () => {
    window.open('resume', '_blank');
  };

  return (
    <nav class="author-nav">
      {portfolioElement ? (
        <>
          <button onClick={scrollToSection('intro')} id="founder_button">
            <h3 className="title">intro</h3>
          </button>

          <button
            onClick={scrollToSection('7tech_portfolio')}
            id="portfolio_button">
            <h3 className="title">PORTFOLIO</h3>
          </button>
        </>
      ) : (
        ''
      )}

      {resume ? (
        <button onClick={openResumeInNewTab}>
          <h3 className="title">RÉSUMÉ</h3>
        </button>
      ) : (
        ''
      )}
    </nav>
  );
}

export default MemberNavigationComponent;
