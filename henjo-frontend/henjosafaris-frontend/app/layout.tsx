import type { Metadata } from "next";
import { Geist, Geist_Mono, Inter } from "next/font/google";
import "./globals.css";
import { ThemeProvider } from './providers';
import Navbar from "@/components/common/Navbar";
import Footer from "@/components/common/Footer";
import WhatsAppButton from "@/components/common/WhatsAppButton";
import { settingsApi } from '@/lib/api/settingsApi';
import { menuApi } from '@/lib/api/menuApi';
import type { SiteSettings } from '@/types/settings';
import type { MenuItem } from '@/types/menu';

const geistSans = Geist({
  variable: "--font-geist-sans",
  subsets: ["latin"],
});
const inter = Inter({ subsets: ['latin'] });

const geistMono = Geist_Mono({
  variable: "--font-geist-mono",
  subsets: ["latin"],
});

export const metadata: Metadata = {
  title: "Henjo Safari",
  description: "Explore the beauty of East Africa with our expert-guided safaris",
};

async function getLayoutData(): Promise<{
    settings: SiteSettings | null;
    navbarMenu: MenuItem[];
    footerMenu: MenuItem[];
}> {
    try {
        const [settingsRes, navbarRes, footerRes] = await Promise.all([
            settingsApi.getSettings(),
            menuApi.getMenu('navbar'),
            menuApi.getMenu('footer'),
        ]);

        return {
            settings: settingsRes.success ? settingsRes.data : null,
            navbarMenu: navbarRes.success ? navbarRes.data : [],
            footerMenu: footerRes.success ? footerRes.data : [],
        };
    } catch (err) {
        console.error('Failed to load site settings/menus:', err);
        return { settings: null, navbarMenu: [], footerMenu: [] };
    }
}

export default async function RootLayout({
    children,
}: {
    children: React.ReactNode;
}) {
    const { settings, navbarMenu, footerMenu } = await getLayoutData();

    return (
        <html lang="en" suppressHydrationWarning>
            <body className={`${inter.className} min-h-screen`}>
                <ThemeProvider>
                    <div
                        className="flex flex-col min-h-screen transition-colors duration-300"
                        style={{
                            background: 'var(--bg-primary)',
                            color: 'var(--text-primary)',
                        }}
                    >
                        <Navbar
                            menuItems={navbarMenu}
                            siteName={settings?.site_name || 'Henjo African Safaris'}
                            logoUrl={settings?.logo_url}
                        />
                        <main className="flex-grow pt-20">
                            {children}
                        </main>
                        <Footer settings={settings} quickLinks={footerMenu} />
                        <WhatsAppButton phone={settings?.phone} />
                    </div>
                </ThemeProvider>
            </body>
        </html>
    );
}