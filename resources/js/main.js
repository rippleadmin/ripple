Water.pages(name => import(`./Pages/${name}`))
Water.components(() => require.context('./Components', true, /\.(js|vue)$/i))
