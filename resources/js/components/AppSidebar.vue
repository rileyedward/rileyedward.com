<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import {
    ExternalLink,
    FolderKanban,
    Inbox,
    LayoutGrid,
    Settings2,
} from '@lucide/vue';
import { computed } from 'vue';
import AppLogo from '@/components/AppLogo.vue';
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard, home } from '@/routes';
import { index as projects } from '@/routes/admin/projects';
import { index as inbox } from '@/routes/inbox';
import { edit as siteSettings } from '@/routes/site-settings';
import type { NavItem } from '@/types';

const page = usePage();

const mainNavItems = computed<NavItem[]>(() => [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
    },
    {
        title: 'Inbox',
        href: inbox(),
        icon: Inbox,
        badge: page.props.unreadMessageCount,
        startsWith: true,
    },
    {
        title: 'Projects',
        href: projects(),
        icon: FolderKanban,
        startsWith: true,
    },
    {
        title: 'Site settings',
        href: siteSettings(),
        icon: Settings2,
    },
]);

const footerNavItems: NavItem[] = [
    {
        title: 'View site',
        href: home().url,
        icon: ExternalLink,
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
