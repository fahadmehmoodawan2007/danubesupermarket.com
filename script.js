const hamburger = document.getElementById('ham-parent');
const navLinks = document.getElementById('nav-links');


const closeButton = document.createElement('button');
closeButton.style.position = 'absolute';
closeButton.style.top = '10px';
closeButton.style.left = '10px';
closeButton.style.background = 'none';
closeButton.style.border = 'none';
closeButton.style.width = '24px';
closeButton.style.height = '24px';
closeButton.style.cursor = 'pointer';
closeButton.style.zIndex = '1000';
closeButton.id = 'nav-close-btn';


const style = document.createElement('style');
style.textContent = `
    #nav-close-btn::before, #nav-close-btn::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 2px;
        background-color: #000;
    }
    #nav-close-btn::before {
        transform: translate(-50%, -50%) rotate(45deg);
    }
    #nav-close-btn::after {
        transform: translate(-50%, -50%) rotate(-45deg);
    }
    @media (max-width: 768px) {
        #nav-close-btn {
            width: 20px;
            height: 20px;
        }
        #nav-close-btn::before, #nav-close-btn::after {
            width: 16px;
            height: 2px;
        }
    }
`;
document.head.appendChild(style);


navLinks.appendChild(closeButton);

hamburger.addEventListener('click', () => {
    navLinks.style.display = 'block';
    navLinks.classList.add('nav-links-mbl');
});

closeButton.addEventListener('click', () => {
    navLinks.style.display = 'none';
    navLinks.classList.remove('nav-links-mbl');
});